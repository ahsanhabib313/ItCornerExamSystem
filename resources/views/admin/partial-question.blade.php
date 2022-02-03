
<div class="container-fluid">
    <div class="border mt-3 admin-panel-shadow">
        <div class="text-secondary fw-bold admin-panel-heading p-3 bg-lisht text-center">
            Add a new question
        </div>
        <hr>
        <div class="p-3">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-success" style="display:none"></div>
                    <form action="{{route('admin.add-new-question')}}" method="post" id="add-question-form">
                        @csrf
                        <div class="mb-3">
                        <div class="form-group">
                            <label for="categories">Select Developer Category</label>
                            <select class="form-control" id="categories" name="category_id">

                                @forelse($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @empty
                                <option value="0">please add category first</option>
                                @endforelse
                            </select>
                        </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="question_type">Select Exam Type</label>
                                <select class="form-control" id="question_type" name="question_type_id" onchange="questionTypeChange(this.value)">

                                    @forelse($question_types as $question_type)
                                    <option value="{{$question_type->id}}">{{strtoupper($question_type->name)}}</option>
                                    @empty
                                    <option value="0">please add exam type first</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="questionMark">Question Mark</label>
                            <input type="number" name="question_mark" type="text" class="form-control" >
                        </div>
                            <div class="mb-3">
                                <label for="question" class="form-label">Question</label>
                                <textarea name="question" id="question"  rows="3" class="form-control"></textarea>
                            </div>
                        <div class="option_section">
                            <div class="mb-3">
                                <label for="option_a" class="form-label">Option A</label>
                                <input type="text" name="option_1" id="option_1" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="option_a" class="form-label">Option B</label>
                                <input type="text" name="option_2" id="option_2" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="option_a" class="form-label">Option C</label>
                                <input type="text" name="option_3" id="option_3" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="option_a" class="form-label">Option D</label>
                                <input type="text" name="option_4" id="option_4" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <!-- <input type="submit" value="Save Question" class="btn btn-primary float-right"> -->
                            <button type="submit" id="add-question-btn" class="btn btn-primary float-right">Save Question</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/question.js')}}"  async></script>
