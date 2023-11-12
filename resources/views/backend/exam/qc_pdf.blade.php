<!DOCTYPE html>
<html>

<head>
    <title>Exam PDF</title>
    <style>
        body {
            text-align: left;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .mcq-container {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .mcq-question {
            margin-bottom: 10px;
        }

        .mcq-options {
            list-style-type: none;
            padding: 0;
        }

        .mcq-option {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <h1>{{ $exam->exam_name }}</h1>
    {{-- <p>{{ $exam->exam_desc }}</p> --}}

    <h2>Questions:</h2>
    <ol class="mcq-container">
        @foreach ($questions as $key => $question)
            <li class="mcq-question">
                <p>{!! $question->question_name !!}</p>
                <ul class="mcq-options">
                    @if ($question->question_option_1)
                        <li class="mcq-option">{!! $question->question_option_1 !!}</li>
                    @endif

                    @if ($question->question_option_2)
                        <li class="mcq-option">{!! $question->question_option_2 !!}</li>
                    @endif

                    @if ($question->question_option_3)
                        <li class="mcq-option">{!! $question->question_option_3 !!}</li>
                    @endif

                    @if ($question->question_option_4)
                        <li class="mcq-option">{!! $question->question_option_4 !!}</li>
                    @endif

                    @if ($question->question_option_5)
                        <li class="mcq-option">{!! $question->question_option_5 !!}</li>
                    @endif

                    @if ($question->question_option_6)
                        <li class="mcq-option">{!! $question->question_option_6 !!}</li>
                    @endif
                </ul>
            </li>

            {{-- Check if it's the last item or an even-indexed item --}}
            @if ($loop->last || ($key + 1) % 2 === 0)
                </li>
                <li>
            @endif
        @endforeach
    </ol>
</body>

</html>
