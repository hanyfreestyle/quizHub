var divs = $(".show-section fieldset");
var now = 0; // currently shown div
divs.hide().first().show(); // hide all divs except the first one
var wrongAttempts = 0; // Initialize the wrong attempts counter

// Function to go to the next question
function next() {
    divs.eq(now).hide();
    now = now + 1 < divs.length ? now + 1 : divs.length - 1; // Prevent going out of bounds
    divs.eq(now).show(); // Show the next question
    console.log(now);

    // If it's the last question, change the next button to submit the result
    if (now === divs.length - 1) {
        $(".next").hide(); // Hide the next button
        $("#sub").show();  // Show the submit button for the final question
    } else {
        $(".next").show(); // Show next button for other questions
        $("#sub").hide();  // Hide submit button for other questions
    }
}


$(".prev").on("click", function () {
    divs.eq(now).hide();
    now = now > 0 ? now - 1 : divs.length - 1; // Go to the previous question
    divs.eq(now).show(); // Show previous question
    console.log(now);

    $(".option").addClass("animate");
    $(".option").removeClass("animateReverse");

    // When navigating back, show the next button and hide the submit button
    $(".next").show();
    $("#sub").hide();
});

// Validate the selected radio button for each step
var checkedradio = false;

function radiovalidate(stepnumber) {
    var checkradio = $("#step" + stepnumber + " input")
        .map(function () {
            if ($(this).is(":checked")) {
                return true;
            } else {
                return false;
            }
        })
        .get();

    checkedradio = checkradio.some(Boolean);
}

// Check if the selected answer is correct
function checkAnswer(stepnumber) {
    var selectedOption = $("#step" + stepnumber + " input:checked");
    var isCorrect = selectedOption.data("correct") == 1;
    if (isCorrect) {
        selectedOption.closest(".option").addClass("correct");
        return true; // Correct answer
    } else {
        selectedOption.closest(".option").addClass("incorrect");
        wrongAttempts++; // Increment wrong attempts if the answer is incorrect
        return false; // Incorrect answer
    }
}


$(document).ready(function () {
    // Iterate through each step dynamically
    $(".next").on("click", function () {
        var stepNumber = $(this).closest("fieldset").attr("id").replace("step", "");
        radiovalidate(stepNumber);

        if (checkedradio == false) {
            $("#error").append(
                '<div class="reveal alert alert-danger">Choose an option!</div>'
            );
        } else {
            var isCorrect = checkAnswer(stepNumber); // Check if the answer is correct

            if (isCorrect) {
                $("#step" + stepNumber + " .option").removeClass("animate");
                $("#step" + stepNumber + " .option").addClass("animateReverse");

                setTimeout(function () {
                    next(); // Go to the next step if the answer is correct
                }, 900);
                countresult(stepNumber); // Update the result count
            } else {
                // Don't go to the next step if the answer is incorrect
                return false;
            }
        }
    });

    // Handle the final step (submit)
    $("#sub").on("click", function () {
        var stepNumber = divs.length; // Last step
        radiovalidate(stepNumber);

        if (checkedradio == false) {
            $("#error").append(
                '<div class="reveal alert alert-danger">Choose an option!</div>'
            );
        } else {
            var isCorrect = checkAnswer(stepNumber);

            if (isCorrect) {
                countresult(stepNumber);
                showresult(); // Show the results after all steps
            }
        }
    });
});
