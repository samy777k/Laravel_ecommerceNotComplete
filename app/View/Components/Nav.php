<?php

namespace App\View\Components;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Nav extends Component
{
    //انستنس سيتم استخدامه للتأشير على الارري داخل الكونفيج
    //يتم ارساله تلقائيا الى ملف الفيو
    public $items;

    //عرفتو عشان قصى الاكتيف على الناف بار اخليه يحط عليه علامة
    //فبعطيه قيمة الراوت الاكتيف عشان اقارن فيها بالسايدبار
    public $active;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //على فرض عملنا كونفيج جديد وسميناه ناف وطبعا الكونفيج بياخد ارري فال ايتم هياشر عليهم
        $this->items = config('nav');
        //اعطيتو اسم الراوت المؤشر عليه
        //بروح عالناف وبقارن هل اكتيف ولا لا
        $this->active = Route::currentRouteName();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav');
    }
}
