@props(['rating'])

@php
    $fullStars = floor($rating);
    $emptyStars = 5 - $fullStars;
@endphp

@for ($i = 1; $i <= $fullStars; $i++)
    <span class="MuiRating-icon MuiRating-iconFilled css-13m1if9" data-rating="{{ $i }}">
        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true"
             viewBox="0 0 24 24" data-testid="StarIcon">
            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
        </svg>
    </span>
@endfor

@for ($i = 1; $i <= $emptyStars; $i++)
    <span class="MuiRating-icon MuiRating-iconEmpty css-1xh6k8t" data-rating="{{ $fullStars + $i }}">
        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true"
             viewBox="0 0 24 24" data-testid="StarBorderIcon">
            <path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"></path>
        </svg>
    </span>
@endfor