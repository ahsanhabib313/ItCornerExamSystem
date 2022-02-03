<div class="container-fluid">
    <div class="border mt-3 admin-panel-shadow pb-lg-5">
        <div class="row">
            <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="text-secondary fw-bold admin-panel-heading pt-3 pb-3 pl-0 bg-lisht">
                    Set anser for question -
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="border p-3">
                    <p class="admin-question-fs">{{$questions[0]->question}}</p>
                    <form action="" method="post" id="add-answer-form">
                        @csrf
                        @php $i=1 @endphp
                        @foreach($options as $option)
                        @php $i++ @endphp
                        <div class="form-check text-size-1 mb-3">
                            <input class="form-check-input" type="radio" name="option" id="exampleRadios{{$i}}" value="{{$option->id}}">
                            <label class="form-check-label" for="exampleRadios{{$i}}">
                                {{$option->option}}
                            </label>
                        </div>
                        @endforeach
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" id="btn-add-ans">Save Answer</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>