<div id="popup-dialog" class="popup-dialog" style="display:none;">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <h2>عنوان البوب اب</h2>

        <!-- الفورم -->
        <form id="popup-form">
            <div class="form-group">
                <label for="name">الاسم</label>
                <input type="text" id="name" name="name" value="{{ $item->name }}" disabled />
            </div>

            <div class="form-group">
                <label for="icon">الأيقونة</label>
                <input type="text" id="icon" name="icon" value="{{ $item->icon_i }}" disabled />
            </div>

{{--            <!-- التحقق من النوع وتغيير شكل الحقول بناءً عليه -->--}}
{{--            @if($item->type == 'text')--}}
{{--                <div class="form-group">--}}
{{--                    <label for="description">الوصف</label>--}}
{{--                    <input type="text" id="description" name="description" value="{{ $item->description }}" />--}}
{{--                </div>--}}
{{--            @elseif($item->type == 'select')--}}
{{--                <div class="form-group">--}}
{{--                    <label for="category">الفئة</label>--}}
{{--                    <select id="category" name="category">--}}
{{--                        <option value="1" {{ $item->category == 1 ? 'selected' : '' }}>الفئة 1</option>--}}
{{--                        <option value="2" {{ $item->category == 2 ? 'selected' : '' }}>الفئة 2</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            @elseif($item->type == 'textarea')--}}
{{--                <div class="form-group">--}}
{{--                    <label for="details">التفاصيل</label>--}}
{{--                    <textarea id="details" name="details">{{ $item->details }}</textarea>--}}
{{--                </div>--}}
{{--            @endif--}}

            <div class="form-group">
                <button type="submit">حفظ</button>
            </div>
        </form>
    </div>
</div>
