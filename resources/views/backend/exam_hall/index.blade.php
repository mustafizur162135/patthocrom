<!DOCTYPE html>
<html>

<head>
    <title>Exam Hall</title>
    <style>
        body {
            text-align: left;
            width: 21cm;
            height: 29.7cm;
            margin: 1cm auto;
            font-family: Arial, sans-serif;
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
            margin-bottom: 20px;
        }

        .mcq-options {
            list-style-type: none;
            padding: 0;
        }

        .mcq-option {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        /* Styling for circular design */
        span.question-number,
        span.option-number {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 10px;
        }

        span.question-number {
            background-color: #3498db;
            color: white;
            text-align: center;
            line-height: 20px;
        }

        span.option-number {
            background-color: #eee7e7;
            color: black;
            text-align: center;
            line-height: 20px;
        }

        /* Button styling */
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        button[type="button"] {
            background-color: #3498db;
            color: white;
        }

        button[type="submit"] {
            background-color: #2ecc71;
            color: white;
            display: none;
            /* Initially hide the submit button */
        }

        /* Media query for print styles */
        @media print {
            body {
                width: 100%;
                height: 100%;
                margin: 0;
            }
        }

    </style>
</head>

<body>

    <h1>{{ $exam->exam_name }}</h1>

    <h2>Questions:</h2>
    <form method="post" action="{{ route('submit.answers') }}" id="examForm">
        @csrf

        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
        <ol class="mcq-container" id="questionContainer">
            @foreach ($questions as $key => $question)
            <li class="mcq-question" data-question-number="{{ $key + 1 }}">
                <p><span class="question-number">{{ $key + 1 }}</span>{!! $question->question_name !!}</p>
                <ul class="mcq-options">
                    @for ($i = 1; $i <= 6; $i++) @php $optionKey="question_option_" . $i; $optionValue=$question->$optionKey;
                        @endphp
                        @if ($optionValue)
                        <li class="mcq-option">
                            <input type="checkbox" value="{{ $question->id }},{{ $i }}" name="solution[]">
                            <span class="option-number">{{ $i }}</span>
                            <label>{!! $optionValue !!}</label>
                        </li>
                        @endif
                        @endfor
                </ul>
            </li>
            @endforeach
        </ol>
        <button type="button" onclick="showPreviousQuestions()">Previous</button>
        <button type="button" onclick="showNextQuestions()">Next</button>
        <button type="submit" id="submitButton">Submit</button>
    </form>

    <script>
        let currentIndex = 0;

        function showPreviousQuestions() {
            const questions = document.querySelectorAll('.mcq-question');
            const visibleQuestions = document.querySelectorAll('.mcq-question:not([style="display: none;"])');

            // Hide current visible questions
            visibleQuestions.forEach(question => {
                question.style.display = 'none';
            });

            // Update the index to show the previous questions
            currentIndex -= 2;
            if (currentIndex < 0) {
                currentIndex = 0;
            }

            // Show the previous two questions
            for (let i = currentIndex; i < currentIndex + 2; i++) {
                const question = questions[i];
                if (question) {
                    question.style.display = 'block';
                }
            }

            // Update the "Next" and "Submit" buttons visibility
            const nextButton = document.querySelector('button[type="button"][onclick="showNextQuestions()"]');
            const submitButton = document.getElementById('submitButton');

            nextButton.style.display = 'inline-block';
            submitButton.style.display = 'none';
        }

        function showNextQuestions() {
            const questions = document.querySelectorAll('.mcq-question');
            const visibleQuestions = document.querySelectorAll('.mcq-question:not([style="display: none;"])');

            // Hide current visible questions
            visibleQuestions.forEach(question => {
                question.style.display = 'none';
            });

            // Update the index to show the next questions
            currentIndex += 2;
            if (currentIndex >= questions.length) {
                currentIndex = questions.length - 2;
            }

            // Show the next two questions
            for (let i = currentIndex; i < currentIndex + 2; i++) {
                const question = questions[i];
                if (question) {
                    question.style.display = 'block';
                }
            }

            // Update the "Next" and "Submit" buttons visibility
            const lastVisibleQuestion = visibleQuestions[visibleQuestions.length - 1];
            const nextButton = document.querySelector('button[type="button"][onclick="showNextQuestions()"]');
            const submitButton = document.getElementById('submitButton');

            if (lastVisibleQuestion && lastVisibleQuestion.dataset.questionNumber === questions.length.toString()) {
                nextButton.style.display = 'none';
                submitButton.style.display = 'inline-block';
            } else {
                nextButton.style.display = 'inline-block';
                submitButton.style.display = 'none';
            }
        }

        // Initially hide all questions except the first two
        window.onload = function() {
            const questions = document.querySelectorAll('.mcq-question');
            for (let i = 2; i < questions.length; i++) {
                questions[i].style.display = 'none';
            }
        };

    </script>
</body>

</html>
