<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //هاي عشان اجيب الاسم للبيرنت اي دي واعرضو بالاندكس
//select a.* , parent.name
//from categories as a LEFT JOIN categories as parent
//ON parent.id = a.parent_id

        $request = request();
        // $query = Category::query();

        // if($name = $request->query('name')){
        //     $query->where('name' , 'LIKE' , "%{$name}%");

        // }
        // if($status = $request->query('status')){
        //     $query->where('status' , $status);

        // }


         $categories = Category::
         filter($request->query())->leftJoin('categories as parent' , 'parent.id' , '=' , 'categories.parent_id')
         ->select([
             'categories.*',
             'parent.name as parent_name'
         ])
         //product from relation (the name of relation)
         ->withCount('product')
         ->paginate(5);

        //  $categories->selectRow('select COUNT(*) from products where category_id = categories.id as count');

        return view('dashboard.category.index' , compact('categories'));
    }

    // public function filter(Request $request){

    //     $name=$request->name;
    //     $status=$request->status;

    //     $categories = Category::where('name' , 'LIKE' , "%{$name}%")
    //     ->orWhere('status' , $status)->paginate(6);
    //     return view('dashboard.category.index' , compact('categories'));
    // }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $category = new Category();
        return view('dashboard.category.create' , compact( 'category' ,'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //validation
        $request->validate([
            'name' => 'required|min:3|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'image' => 'image|dimensions:min_width=100,min_height=100',
            'status' => 'in:active,archived'
        ]);


        $name = $request['name'];
        $parent = $request['parent_id'];
      //  $slug = $request->merge(['slug' => Str::slug($name)]);
        $discription = $request['description'];
        $image = $request['image'];


        if($request['radio']=="active"){
            $status = "active";
        }else{
            $status = "archived";
        }

        // $newImageName = uniqid() . '-' . Str::slug($name . '-') . '.' . $request->image->extension();
        // $request->image->move(public_path('uploads') , $newImageName);
//sure this file exist
        if($request->hasFile('image')){
            //get the image are you need to store his
            $file = $request->file('image');
            //function store make every thing : first parameter is name of the file created
            //second parameter for what the path are you store youre photos
            //the public path is : storage=>app=>public=>category.
            //name of paths exist in fileSystem in config file
            $path = $file->store('category' , [
                'disk' => 'public'
            ]);
        }

        $categories = new Category();
        $categories->name = $name;
        $categories->parent_id = $parent;
        $categories->slug = Str::slug($name);
        $categories->discription = $discription;
        if(isset($path)){
            $categories->image = $path;
        }

        $categories->status = $status;

        $categories->save();
        // $request->merge(['slug' => Str::slug($request->post('name'))]);
        // $category = Category::create($request->all());
        return redirect()->route('createCategory')->with('success' , "Created Category!!");

        //another way
        //بستغني عن كل العمليات الي فوق
       // $category = new Category($request->all());
       //$category->save();
       //------------------
       //OR
       //عشان هاي الطريقة استخدمها لازم اروح على المودل واعرف بروبيريتي اسمو فيلابل واعطيه الحقول الي بدي اخزنهم
      // $category = Category::create($request->all());


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorys = Category::with('product')->findOrFail($id);
        
       // dd($category->toArray());
        return view('dashboard.category.show' , compact('categorys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryy = Category::find($id);
        if(!$categoryy)
        abort('404');

   //     $categories = Category::select('*')->where('id' , $id)->first();

//بحيث انو ما يكون الابن هوا نفسو الاب للاب الرئيسي
            $parent_id = Category::select('*')->where('id' , '!=' , $id)
            ->where(function($query) use($id){
                $query->whereNull('parent_id')
                ->orWhere('parent_id' , '!=' ,$id);
            })

            ->get();


        return view('dashboard.category.edit')->with('category' , $categoryy)->with('categories' ,$parent_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'image' => 'image|dimensions:min_width=100,min_height=100',
            'status' => 'in:active,archived'
        ]);



        $name = $request['name'];
        $parent = $request['parent_id'];
        $discription = $request['description'];
        if($request['radio']=="active"){
            $status = "active";
        }else{
            $status = "archived";
        }
        $category = Category::find($id);
        $oldImage = $category->image;

        // $updateImage = uniqid() . '-' . Str::slug($name , '-') . '.' . $request->image->extension();
        // $request->image->move(public_path('uploads') , $updateImage);

        $newImage=$oldImage;
        $file="";
        if($request->hasFile('image')){
            $file = $request->file('image');

            $newImage = $file->store('category',[
                'disk' => 'public'
            ]);
        }



        if($oldImage && $file!=null){
            Storage::disk('public')->delete($oldImage);
        }





        Category::where('id' , $id)->update(['name' => $name , 'parent_id' => $parent , 'discription' => $discription
                    ,'image' => $newImage , 'status' => $status , 'slug' => Str::slug($name)
        ] );
        return redirect()->route('index')->with('success' , 'Updated Category!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();


        return redirect()->route('index')->with('successDelete' , 'Deleted Category!!');
    }

                //Soft Delete

    public function getTrach(){
        $trach = Category::onlyTrashed()->paginate(5);
        return view('dashboard.category.trashed')->with('categories' , $trach);
    }

    public function restoreCategory($id){
        $categoryRestore=Category::onlyTrashed()->findOrFail($id);
        $categoryRestore->restore();

        return redirect()->route('trachCategories')->with("successRestore" , "restore successfully!!");
    }

    public function forceDelete($id){
        $force = Category::onlyTrashed()->findOrFail($id);
        if($force->image){
            Storage::disk('public')->delete($force->image);
        }
        $force->forceDelete();



        return redirect()->route('trachCategories');
    }
}
