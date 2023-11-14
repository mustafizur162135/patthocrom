<!DOCTYPE html>
<html>

<head>
    <title>Exam PDF</title>
    <style>
        body {
            text-align: left;
            width: 21cm;
            height: 29.7cm;
            margin: 1cm auto;
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
            display: inline-block;
            margin-right: 10px;
            /* Adjust as needed */
        }

        /* Styling for circular design */
        span.question-number,
        span.option-number {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 5px;
        }

        span.question-number {
            background-color: #3498db;
            /* Adjust the color as needed */
            color: white;
            text-align: center;
            line-height: 20px;
        }

        span.option-number {
            background-color: #eee7e7;
            /* Adjust the color as needed */
            color: black;
            text-align: center;
            line-height: 20px;
        }

        /* Print button styling */
        .print-button {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 10px;
            background-color: #27ae60;
            /* Adjust the color as needed */
            color: white;
            cursor: pointer;
            z-index: 999;
            /* Ensure the button is on top */
        }

        /* Media query for print styles */
        @media print {
            body {
                width: 100%;
                height: 100%;
                margin: 0;
            }

            .print-button {
                display: none;
            }
        }

    </style>
</head>

<body>
    <button class="print-button" onclick="window.print()">Print</button>

    <h1>{{ $exam->exam_name }}</h1>

    <h2>Questions:</h2>
    <ol class="mcq-container">
        @foreach ($questions as $key => $question)
        <li class="mcq-question">
            <p><span class="question-number">{{ $key + 1 }}</span>{!! $question->question_name !!}</p>
            <ul class="mcq-options">
                @for ($i = 1; $i <= 6; $i++) @php $optionKey="question_option_" . $i; $optionValue=$question->$optionKey;
                    @endphp
                    @if ($optionValue)
                    <span class="option-number">{{ $i }}</span>
                    <li class="mcq-option">{!! $optionValue !!}</li>
                    @endif
                    @endfor
            </ul>
        </li>
        @endforeach
    </ol>
</body>

</html>
