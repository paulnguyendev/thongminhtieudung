<?php
namespace App\Helpers\Package;

use App\Helpers\Obn;
use App\Models\CourseModel;
use App\Models\TaxonomyModel;
class CoursePackage
{
    private static $taxnomyModel;
    public static function categoryList()
    {
        $model = new TaxonomyModel();
        $items = $model->whereNull('parent_id')->get();
        return $items;
    }
    public static function showCategory($device = 'desktop')
    {
        $xhtml = null;
        $items = self::categoryList();
        $model = new TaxonomyModel();
        $childs = [];
        $xhtml .= sprintf("<a class='item'
        href='%s'
        data-child-category='%s'>
        <div class='parent-category'>
            <div class='title'>%s</div>
            %s
        </div>
    </a>", route('fe_combo/index'),"","Tất cả combo","");
        foreach ($items as $item) {
            $id = $item->id;
            $childs = $model->defaultOrder()->descendantsOf($id);
            $xhtml .= self::categoryItem($item, $device);
        }
        return $xhtml;
    }
    public static function categoryItem($item, $device = 'desktop')
    {
        $model = new TaxonomyModel();
        $name = $item->name ?? "";
        $id = $item->id;
        $childCategory  = $model->defaultOrder()->descendantsOf($id);
        $childCategory = count($childCategory) > 0 ? $childCategory->toArray() : [];
        $childCategory = array_map(function ($item) {
            $item['url'] = self::categoryLink($item['slug']);
            return $item;
        }, $childCategory);
        $childCategory = count($childCategory) > 0 ? json_encode($childCategory) : "";
        $childIcon = $childCategory ? '<div class="child-icon"><i class="fas fa-caret-right"></i></div>' : "";
        $isChild = $childCategory ? 'true' : "false";
        $slug = $item->slug ?? "";
        $categoryLink =  self::categoryLink($slug);
        if ($device == 'desktop') {
            $xhtml = sprintf(
                "<a class='item'
        href='%s'
        data-child-category='%s'>
        <div class='parent-category'>
            <div class='title'>%s</div>
            %s
        </div>
    </a>",
                $categoryLink,
                $childCategory,
                $name,
                $childIcon
            );
        } else {
            $xhtml = sprintf(
                "<a class='item' data-is-child='%s'
                href='%s'
                data-child-category='%s'>
                <img src='https://cdn-skill.kynaenglish.vn/uploads/categories/162/img/menu_icon-1597659288.png'>
                <div class='name'>%s</div>
               %s
            </a>",
                $isChild,
                $categoryLink,
                $childCategory,
                $name,
                $childIcon,
            );
        }
        return $xhtml;
    }
    public static function categoryLink($slug)
    {
        return route('fe_course/category', ['slug' => $slug]);
    }
    public static function videoLink($videoId, $autoplay = 'true', $is_youtube = 0)
    {
        
        $libid = config('obn.bunny.libid');
        $iframeUrl = "https://iframe.mediadelivery.net";
        $result = $is_youtube == 1 ? Obn::getYoutubeEmbedUrl($videoId) :  "{$iframeUrl}/embed/{$libid}/{$videoId}?autoplay={$autoplay}";
        return $result;
    }
    public static function getFirstLesson($course_id) {
        $courseModel = new CourseModel();
        $course = $courseModel::find($course_id);
        $lesson = $course->lesson()->first();
        return $lesson;
    }
}
