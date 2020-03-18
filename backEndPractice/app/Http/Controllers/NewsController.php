<?php

namespace App\Http\Controllers;

use App\News;
use App\News_img;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $all_news = News::all();  //從News引用，引用所有資料
        return view('admin/news/index', compact("all_news"));  //將這筆資料夾帶進這頁面
    }
    public function create()
    {
        return view('admin/news/create');
    }

    public function store(Request $request)   //多檔案上傳
    {
        $news_data = $request->all();   //將送來的request存成變數
        $file = $request->file("url")->store('news','public'); //將url欄位中的檔案進行儲存，並抓到路徑
        $news_data['url'] = $file;  //將原先的url欄位中的檔案改成檔案的路徑進行儲存
        $father_news = News::create($news_data);  //將資料用create方式儲存進資料庫，並建立成一變數
        if($request->hasFile('sub_img')){  //判斷除了主img之外是否有上傳多個檔案
            // !!!注意!!!  input在上傳多比檔案時送來的資料型態會是陣列
            foreach ($request->sub_img as  $sub_img) {  //對由上傳的檔案s組成的陣列進行foreach，抓出每一筆檔案
                $sub_path = $sub_img->store('news','public');  //對檔案進行儲存，並抓到檔案名稱(路徑)
                $foreign_key = $father_news->id;  //利用上面已經儲存進主資料表的資料，抓出id值作為關聯資料的foreign key
                $news_img = new News_img;  //利用new加上model名稱的方法，建立新資料
                $news_img->img_url = $sub_path;  //一一將對應的欄位填入值
                $news_img->news_id = $foreign_key;
                $news_img->save();  //最後要進行save，否則無效
            }
        }
        return redirect('/home/news');
    }



    public function edit($id)
    {
        // $news = News::with("news_imgs")->find($id);
        $news = News::find($id);
        $news_imgs = News::find($id)->news_imgs->sortByDesc("sort");

        return view('admin/news/edit',compact('news','news_imgs'));
    }

    public function update(Request $request,$id)
    {
        // 因csrf的關係，有toke，更新時有「可能」需將token排除
        // $update_news = $request->except("_token");

        $request_data = $request->all();  //將送來的request存成變數
        $item = News::find($id);  //以id抓到正在動作的是哪一筆資料

        // 刪除舊有圖片:
        if($request->hasFile('url')){ //判斷是否有新增檔案上傳
            $old_img = $item->url;     //若有，抓到原資料中的url欄位內容

            // !!!注意!!!  用storage時需安裝套件:league/flysystem-cached-adapter
            Storage::disk('public')->delete($old_img);  //用Storage刪除

            $new_img = $request->file('url')->store('news','public');  //抓到新上傳的檔案並儲存進public
            $request_data["url"] = $new_img;  //將送進來的request中的url改成儲存的檔名
        }

        // 上傳新副圖片(sub_img):
        if($request->hasFile('sub_img')){ //判斷是否有新增副圖片上傳

            foreach ($request->sub_img as $sub_img) {
                $sub_img_path = $sub_img->store('news',"public");   //儲存檔案，並將名稱設為變數
                $new_sub_img = new News_img;  //用new建立新的一筆資料，依欄位名稱填入值
                $new_sub_img->news_id = $id;
                $new_sub_img->img_url = $sub_img_path;
                $new_sub_img->save();
            }
        }

        $item->update($request_data);  //進行資料更新
        return redirect('/home/news');
    }

    public function delete($id)
    {
        $item = News::find($id);  //找到正在執行動作的是哪一筆資料
        Storage::disk('public')->delete("$item->url");  //將資料的檔案刪除
        $item->delete(); //刪除資料

        $sub_imgs = News_img::where('news_id',$id)->get();  //用where抓到news_id欄位符合$id的資料，並用get取出來
        foreach($sub_imgs as $news_img){   //因為是多筆資料，為陣列型態，對每個資料進行刪除檔案及資料
            Storage::disk('public')->delete("$news_img->img_url");  //將資料的檔案刪除
            $news_img->delete(); //刪除資料
        }

        return redirect("/home/news");
    }

    public function sort_down(Request $request)
    {
        // 依照ajax送進來的資料，抓到正在動作的是哪一筆資料(主資料)
        $item = News::find($request->data_id);
        // 抓到主資料的目前sort值
        $sort_value = $item->sort;
        // 用where方法，抓到News資料庫的sort欄位中值比主資料sort值還小的資料
        // 但抓出的資料有可能是複數比資料，所以將抓出來的資料依sort欄位的值大小進行排序(依up、down來更改排序方式)
        // 排序後以first抓到第一筆，存成變數(目標資料)
        $target = News::where('sort','<',$sort_value)->orderby('sort','desc')->first();

        if ($target == null) {
            // 進行判斷，如果目標資料不存在，代表主資料的sort值已經是最小
            // 第二個判斷，如果sort值大於0，則讓sort值減1，並變更進資料庫
            if($sort_value > 0){
            $item->sort = $sort_value - 1;
            }
            // 建立一個新變數，值是主資料的sort值減1，作為傳回頁面的資料
            $sort_value_new = $sort_value - 1;
            // 建立要回傳的資料，也就是原先值-1之後的數值
            $result = [$sort_value_new];

        }else{
            // 目標資料如果存在，就可以將主資料的sort值與目標資料的sort值互換
            // 將目標資料的值建立成變數
            $target_sort_value = $target->sort;
            // 主資料的值改成目標資料的值
            $item->sort = $target_sort_value;
            // 目標資料的值改成主資料的值
            $target->sort = $sort_value;
            // 將目標資料的變更更新進資料庫
            $target->update();
            // 建立新變數表示新的索引值，
            $sort_value_new = $sort_value;
            $target_id = $target->id;
            $result = [$target_sort_value,$sort_value_new,$target_id];

        }
        $item->update();
        return $result;
    }


    public function sort_up(Request $request)
    {
        // 依照ajax送進來的資料，抓到正在動作的是哪一筆資料(主資料)
        $item = News::find($request->data_id);
        // 抓到主資料的目前sort值
        $sort_value = $item->sort;
        // 用where方法，抓到News資料庫的sort欄位中值比主資料sort值還大的資料
        // 但抓出的資料有可能是複數比資料，所以將抓出來的資料依sort欄位的值大小進行排序(依up、down來更改排序方式)
        // 排序後以first抓到第一筆，存成變數(目標資料)
        $target = News::where('sort','>',$sort_value)->orderby('sort','asc')->first();
        // 先建立對象資料更改後的sort值，也就是主資料的sort值

        if ($target == null) {
            // 進行判斷，如果目標資料不存在，代表主資料的sort值已經是最大
            $item->sort = $sort_value + 1;

            // 建立一個新變數，值是主資料的sort值減1，作為傳回頁面的資料
            $sort_value_new = $sort_value + 1;
            // 建立要回傳的資料，也就是原先值+1之後的數值
            $result = [$sort_value_new];

        }else{
            // 目標資料如果存在，就可以將主資料的sort值與目標資料的sort值
            $target_sort_value = $target->sort;
            $item->sort = $target_sort_value;
            $target->sort = $sort_value;
            $target->update();
            $sort_value_new = $sort_value;
            $target_id = $target->id;
            $result = [$target_sort_value,$sort_value_new,$target_id];

        }
        $item->update();
        return $result;
        // 舊寫法
        // $item = News::find($id);
        // $sort_value = $item->sort;
        // $target = News::where('sort','>',$sort_value)->orderby('sort','asc')->first();
        // if ($target == null) {
        //     $item->sort = $sort_value + 1;
        // }else{
        //     $target_sort_value = $target->sort;
        //     $item->sort = $target_sort_value;
        //     $target->sort = $sort_value;
        //     $target->update();
        // }
        // $item->update();
        // return redirect('home/news');
    }




    public function delete_sub_img(Request $request)
    {
        $id = $request->sub_img_id;
        $sub_img = News_img::find($id)->first();
        Storage::disk('public')->delete($sub_img->img_url);  //用Storage刪除
        $sub_img->delete();

        return $id;
    }

    public function change_sub_img_sort(Request $request)
    {
        $sub_img_id = $request->sub_img_id;
        $changed_value = $request->changed_value;
        $item = News_img::find($sub_img_id);
        $item->sort = $changed_value;
        $item->update();
        return $item;
    }
}
