<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category as Categories;
use Illuminate\Http\Request;

class Category extends Component
{
    public $categories, $type, $description, $category_id, $amount;
    public $updateCategory = false;

    protected $listeners = [
        'deleteCategory'=>'destroy'
    ];

    // Validation Rules
    protected $rules = [
        'type'=>'required',
        'description'=>'required',
		'amount'=>'required'
    ];

    public function render(){
        // we get all Data from Table according Position name
        $this->categories = Categories::orderBy('position')->get();
        return view('livewire.category');
       }
// write this for datas in Models like this
    public function resetFields(){
        $this->type = '';
        $this->description = '';
		$this->amount = '';
    }
// save new data in table like this
    public function store(Request $request){
        // Validate Form Request
        $this->validate();

        try{
            // Create Category
            Categories::create([
                'type'=>$this->type,
                'description'=>$this->description,
				'amount'=>$this->amount
            ]);
    
            // Set Flash Message
            //session()->flash('success','Category Created Successfully!!');
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Category Created Successfully!!"
            ]);

            // Reset Form Fields After Creating Category
            $this->resetFields();
        }catch(\Exception $e){
            // Set Flash Message
            //session()->flash('error','Something goes wrong while creating category!!');
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong while creating category!!"
            ]);

            // Reset Form Fields After Creating Category
            $this->resetFields();
        }
    }
// edit 
    public function edit($id){
        $category = Categories::findOrFail($id);
        $this->type = $category->type;
        $this->description = $category->description;
		$this->amount = $category->amount;
        $this->category_id = $category->id;
        $this->updateCategory = true;
    }
// canceling for edit
    public function cancel()
    {
        $this->updateCategory = false;
        $this->resetFields();
    }

    public function update(){

        // Validate request
        $this->validate();

        try{

            // Update category
            Categories::find($this->category_id)->fill([
                'type'=>$this->type,
                'description'=>$this->description,
				'amount'=>$this->amount
            ])->save();

            //session()->flash('success','Category Updated Successfully!!');
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Category Updated Successfully!!"
            ]);
    
            $this->cancel();
        }catch(\Exception $e){
            //session()->flash('error','Something goes wrong while updating category!!');
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong while updating category!!"
            ]);
            $this->cancel();
        }
    }
// destroy data
    public function destroy($id){
        try{
            Categories::find($id)->delete();
            //session()->flash('success',"Category Deleted Successfully!!");
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Category Deleted Successfully!!"
            ]);
        }catch(\Exception $e){
            //session()->flash('error',"Something goes wrong while deleting category!!");
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Something goes wrong while deleting category!!"
            ]);
        }
    }
// the name of this function is same in Category.blade.php
    public function updateTaskOrder($categories){
        //if we move each row new position change in Table 
        foreach($categories as $item){
          categories::whereId($item['value'])->update(['position' => $item['order']]);
        }
      }
}