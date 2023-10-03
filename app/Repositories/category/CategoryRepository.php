<?php

namespace App\Repositories\Category;

use App\Models\User;
use App\Models\Category;
use App\Models\Notification as NotificationModel;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CategoryAdded;

class CategoryRepository implements CategoryInterface 
{
    use ImageTrait;

    public function index($request)
    {
        return Category::
            when($request->name_ar != null,function ($q) use($request){
                return $q->where('name_ar','like','%'.$request->name_ar.'%');
            })
            ->when($request->name_en != null,function ($q) use($request){
                return $q->where('name_en','like','%'.$request->name_en.'%');
            })
            ->when($request->photo != null,function ($q) use($request){
                return $q->where('photo','like','%'.$request->photo.'%');
                // ->orWhereRelation('province','name','like','%'.$request->search.'%')
            })
            ->get();
    }



    public function show($id)
    {
        return Category::findOrFail($id);
    }



    public function store($request)
    {
        try {
            $validated = $request->validated();
            //upload image
            if ($request->photo) {
                $photo_name = $this->uploadImage($request->photo, 'attachments/category');
            }
            //insert data
            $category = Category::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'photo'   => $request->photo ? $photo_name : null,
            ]);
            if (!$category) {
                session()->flash('error');
                return redirect()->back();
            }
            //send notification mail
            $user = User::where('id', Auth::user()->id)->get();
            Notification::send($user, new CategoryAdded($category->id));

            session()->flash('success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function update($request)
    {
        try {
            $validated = $request->validated();
            $category = Category::findOrFail($request->id);
            if (!$category) {
                session()->flash('error');
                return redirect()->back();
            }
            //upload image
            if ($request->photo) {
                //remove old photo
                Storage::disk('attachments')->delete('category/' . $category->photo);
                $photo_name = $this->uploadImage($request->photo, 'attachments/category');
            }
            $category->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'photo'   => $request->photo ? $photo_name : $category->photo,
            ]);
            if (!$category) {
                session()->flash('error');
                return redirect()->back();
            }
            session()->flash('success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy($request)
    {
        try {
            // $related_table = realed_model::where('category_id', $request->id)->pluck('category_id');
            // if($related_table->count() == 0) { 
                $category = Category::findOrFail($request->id);
                if (!$category) {
                    session()->flash('error');
                    return redirect()->back();
                }
                $category->delete();
                session()->flash('success');
                return redirect()->back();
            // } else {
                // session()->flash('canNotDeleted');
                // return redirect()->back();
            // }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function deleteSelected($request)
    {
        try {
            $delete_selected_id = explode(",", $request->delete_selected_id);
            // foreach($delete_selected_id as $selected_id) {
            //     $related_table = realed_model::where('category_id', $selected_id)->pluck('category_id');
            //     if($related_table->count() == 0) {
                    $categories = Category::whereIn('id', $delete_selected_id)->delete();
                    session()->flash('success');
                    return redirect()->back();
            //     } else {
            //         session()->flash('canNotDeleted');
            //         return redirect()->back();
            //     }
            // }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        
    }



    public function forceDelete($request)
    {
        try {
            $category = Category::withTrashed()->where('id', $request->id)->first();
            if (!$category) {
                session()->flash('error');
                return redirect()->back();
            }
            Storage::disk('attachments')->delete('category/' . $category->photo);
            $category->forceDelete();
            session()->flash('success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function restore($request)
    {
        try {
            $category = Category::withTrashed()->where('id', $request->id)->restore();
            if (!$category) {
                session()->flash('error');
                return redirect()->back();
            }
            session()->flash('success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function archived()
    {
        return Category::onlyTrashed()->get();
    }



    public function showNotification($id)
    {
        $notification = NotificationModel::findOrFail($id);
        $notification->update([
            'read_at' => now(),
        ]);
        return Category::findOrFail($id);
    }
}
