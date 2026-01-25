<?php

namespace Tabour\Homepage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Tabour\Homepage\Models\HomepageSection;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateHomepageSectionRequest; 

class SectionController extends Controller
{
    public function index()
    {
        $sections = HomepageSection::orderBy('order')->get();
        return view('tabour-homepage::admin.index', compact('sections'));
    }

    public function create()
    {
        return view('tabour-homepage::admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:hero,feature_grid,cta,contact_info',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'features' => 'nullable|array',
            'contact' => 'nullable|array',
            'contact.email' => 'nullable|email',
            'contact.website' => 'nullable|url',
            'contact.facebook' => 'nullable|url',
            'contact.twitter' => 'nullable|url',
            'contact.instagram' => 'nullable|url',
            'contact.linkedin' => 'nullable|url',
        ]);

        $data = [
            'type' => $validated['type'],
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->processAndStoreImage($request->file('image'));
        }

        if ($request->type === 'feature_grid' && isset($validated['features'])) {
            $features = [];
            foreach ($request->features as $index => $featureData) {
                if (empty($featureData['title']))
                    continue;
                $feature = [
                    'title' => $featureData['title'] ?? '',
                    'description' => $featureData['description'] ?? '',
                    'image_path' => null,
                ];
                if (isset($request->file('features')[$index]['image'])) {
                    $feature['image_path'] = $this->processAndStoreImage($request->file('features')[$index]['image'], 300);
                }
                $features[] = $feature;
            }
            $data['content'] = ['features' => $features];
        } elseif ($request->type === 'contact_info') {
            $c = $validated['contact'] ?? [];
            $data['content'] = [
                'contact' => [
                    'address' => $c['address'] ?? '',
                    'phone' => $c['phone'] ?? '',
                    'email' => $c['email'] ?? '',
                    'website' => $c['website'] ?? '',
                    'facebook' => $c['facebook'] ?? '',
                    'twitter' => $c['twitter'] ?? '',
                    'instagram' => $c['instagram'] ?? '',
                    'linkedin' => $c['linkedin'] ?? '',
                    'map_embed' => isset($c['map_embed']) ? trim((string) $c['map_embed']) : '',
                ],
            ];
        }

        $data['order'] = (int) HomepageSection::max('order') + 1;
        HomepageSection::create($data);

        return redirect()->route('superadmin.homepage-sections.index')->with('success', [
            'title' => ['en' => 'Section created', 'ar' => 'تم إنشاء القسم'],
            'detail' => ['en' => 'The section has been created successfully.', 'ar' => 'تم إنشاء القسم بنجاح.'],
            'level' => 'success',
        ]);
    }

    public function edit(HomepageSection $section)
    {
        return view('tabour-homepage::admin.edit', compact('section'));
    }

    public function update(UpdateHomepageSectionRequest $request, HomepageSection $section)
    {
        $validated = $request->validated();

        // الحقول العامة
        $data = ['title' => $validated['title'] ?? $section->title];

        if ($request->has('subtitle')) {
            $data['subtitle'] = $request->filled('subtitle') ? trim((string) $validated['subtitle']) : null;
        } else {
            $data['subtitle'] = $section->subtitle;
        }

        // صورة القسم إن لزم
        if ($request->hasFile('image')) {
            if ($section->image_path) {
                Storage::disk('public')->delete($section->image_path);
            }
            $data['image_path'] = $this->processAndStoreImage($request->file('image'));
        }

        // تحديث ميزات feature_grid
        if ($section->type === 'feature_grid' && isset($validated['features'])) {
            $features = $section->content['features'] ?? [];
            foreach ($request->features as $index => $featureData) {
                if ($index === 'new' && empty($featureData['title'])) {
                    continue;
                }

                $feature = $features[$index] ?? [];
                $feature['title'] = $featureData['title'] ?? '';
                $feature['description'] = $featureData['description'] ?? '';

                if (isset($request->file('features')[$index]['image'])) {
                    if (!empty($feature['image_path'])) {
                        Storage::disk('public')->delete($feature['image_path']);
                    }
                    $feature['image_path'] = $this->processAndStoreImage($request->file('features')[$index]['image'], 400);
                }

                if ($index === 'new') {
                    $features[] = $feature;
                } else {
                    $features[$index] = $feature;
                }
            }
            $data['content'] = ['features' => array_values($features)];
        }

        // تحديث بيانات contact_info
        if ($section->type === 'contact_info') {
            $c = $request->input('contact', []);
            $existing = $section->content['contact'] ?? [];
            $content = $section->content ?? [];

            $content['contact'] = [
                'address' => $c['address'] ?? ($existing['address'] ?? ''),
                'phone' => $c['phone'] ?? ($existing['phone'] ?? ''),
                'email' => $c['email'] ?? ($existing['email'] ?? ''),
                'website' => $c['website'] ?? ($existing['website'] ?? ''),
                'facebook' => $c['facebook'] ?? ($existing['facebook'] ?? ''),
                'twitter' => $c['twitter'] ?? ($existing['twitter'] ?? ''),
                'instagram' => $c['instagram'] ?? ($existing['instagram'] ?? ''),
                'linkedin' => $c['linkedin'] ?? ($existing['linkedin'] ?? ''),
                'map_embed' => array_key_exists('map_embed', $c)
                    ? trim((string) $c['map_embed'])
                    : ($existing['map_embed'] ?? ''),
            ];

            $data['content'] = $content;
        }

        $section->update($data);
        return redirect()
            ->route('superadmin.homepage-sections.index')
            ->with('success', [
                'title' => ['en' => 'Section updated', 'ar' => 'تم تحديث القسم'],
                'detail' => ['en' => 'Changes saved successfully.', 'ar' => 'تم حفظ التغييرات بنجاح.'],
                'level' => 'success',
            ]);
    }


    public function destroy(HomepageSection $section)
    {
        if ($section->image_path)
            Storage::disk('public')->delete($section->image_path);
        $section->delete();
        return back()->with('success', [
            'title' => ['en' => 'Section deleted', 'ar' => 'تم حذف القسم'],
            'detail' => ['en' => 'The section has been removed.', 'ar' => 'تمت إزالة القسم.'],
            'level' => 'success',
        ]);
    }

    public function destroyFeature(HomepageSection $section, $featureIndex)
    {
        $content = $section->content;
        $features = $content['features'] ?? [];
        if (isset($features[$featureIndex])) {
            if (!empty($features[$featureIndex]['image_path'])) {
                Storage::disk('public')->delete($features[$featureIndex]['image_path']);
            }
            unset($features[$featureIndex]);
            $content['features'] = array_values($features);
            $section->content = $content;
            $section->save();
            return back()->with('success', [
                'title' => ['en' => 'Feature deleted', 'ar' => 'تم حذف الميزة'],
                'detail' => ['en' => 'The feature was deleted from the grid.', 'ar' => 'تم حذف الميزة من الشبكة.'],
                'level' => 'success',
            ]);
        }
        return back()->with('error', [
            'title' => ['en' => 'Delete failed', 'ar' => 'فشل الحذف'],
            'detail' => ['en' => 'Feature not found.', 'ar' => 'الميزة غير موجودة.'],
        ]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:homepage_sections,id'
        ]);
        foreach ($request->order as $index => $id) {
            HomepageSection::where('id', $id)->update(['order' => $index]);
        }
        return response()->json(['status' => 'success']);
    }

    private function processAndStoreImage($file, $maxWidth = 1200): ?string
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = 'homepage/' . $filename;

        [$width, $height, $type] = getimagesize($file);
        switch ($type) {
            case IMAGETYPE_JPEG:
                $src = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG:
                $src = imagecreatefrompng($file);
                break;
            case IMAGETYPE_GIF:
                $src = imagecreatefromgif($file);
                break;
            case IMAGETYPE_WEBP:
                $src = imagecreatefromwebp($file);
                break;
            default:
                return null;
        }

        if ($width <= $maxWidth) {
            Storage::disk('public')->put($path, file_get_contents($file));
            return $path;
        }

        $newWidth = $maxWidth;
        $newHeight = ($height / $width) * $newWidth;

        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $tempPath = tempnam(sys_get_temp_dir(), 'resized');
        imagejpeg($tmp, $tempPath, 90);
        Storage::disk('public')->put($path, file_get_contents($tempPath));

        imagedestroy($src);
        imagedestroy($tmp);
        @unlink($tempPath);

        return $path;
    }
}
