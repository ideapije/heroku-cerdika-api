@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('cerdika.logbook.store', $member) }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $group }}" name="g" />
                @foreach ($questions as $key => $question)
                <div class="form-group">
                    <label for="ques{{ $question->id }}">{{ $question->text }}</label>
                    <input type="hidden" name="logbook[][question_id]" id="ques{{ $question->id }}" value="{{ $question->id }}" />
                    @foreach ($question->choices as $choice)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="logbook[{{ $key }}][choice_id]" id="radio{{ $question->id.$choice->id }}"
                            value="{{ $choice->id }}" />
                        <label class="form-check-label" for="radio{{ $question->id.$choice->id }}">
                            {{ $choice->text }}
                        </label>
                    </div>
                    @endforeach
                    @error("logbook.$key.choice_id")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @endforeach
                <div class="mt-3 p-2">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        SUBMIT
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection