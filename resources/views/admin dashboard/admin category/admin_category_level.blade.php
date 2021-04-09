 <div class="form-group">
    <label>select category level</label>
                  <select name="parent_name" id="parent_id" class="form-control select2" style="width: 100%;">
                    <option value="0" @if(isset($edit_cate['parent_id']) && $edit_cate['parent_id']==0) selected="" @endif>main category</option>
                    
 @if(!empty($get_cate_level))
 @foreach($get_cate_level as $category)
 <option value="{{$category['id']}}" @if(isset($edit_cate['parent_id']) && $edit_cate['parent_id']==$category['id']) selected="" @endif>{{$category['category_name']}}</option>{{--we also show sub category--}}{{--create relation in category medel--}}
 @if(!empty($category['sub_categories']))
 @foreach($category['sub_categories'] as $sub_cate)
 <option value="{{$sub_cate['id']}}">&nbsp;&raquo;&nbsp;{{$sub_cate['category_name']}}</option>
 @endforeach
 @endif
 @endforeach 
 @endif                  
                    </select>
                </div>
                {{--https://www.youtube.com/watch?v=YuBR-BDX2zo&list=PLLUtELdNs2ZaHaFmydqjcQ-YyeQ19Cd6u&index=26--}}