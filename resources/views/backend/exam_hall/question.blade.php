<li class="mcq-question">
    <p><span class="question-number">{{ $questionIndex + 1 }}</span>{!! $question->question_name !!}</p>
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
