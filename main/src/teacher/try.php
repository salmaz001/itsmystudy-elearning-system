<!DOCTYPE html>
<html>
<head>
    <title>Add Questions</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var questionCount = 1;

            $("#addQuestion").click(function() {
                questionCount++;

                var questionDiv = $("<div>").attr("id", "question" + questionCount);
                var questionLabel = $("<label>").text("Question " + questionCount);
                var questionInput = $("<input>").attr({
                    type: "text",
                    name: "question[]"
                });

                var optionCount = 3; // Set default option count to 3
                var optionDiv = $("<div>").attr("id", "options" + questionCount);
                var optionLabel = $("<label>").text("Options for Question " + questionCount);

                // Loop to create option inputs and select dropdown
                for (var i = 1; i <= optionCount; i++) {
                    var optionInput = $("<input>").attr({
                        type: "text",
                        name: "options[" + questionCount + "][]"
                    });
                    optionDiv.append(optionInput);
                }

                var correctAnswerLabel = $("<label>").text("Correct Answer");
                var correctAnswerSelect = $("<select>").attr("name", "correct_answer[]");

                // Loop to create options for the correct answer dropdown
                for (var i = 1; i <= optionCount; i++) {
                    var option = $("<option>").attr("value", i).text("Option " + i);
                    correctAnswerSelect.append(option);
                }

                optionDiv.append(correctAnswerLabel, correctAnswerSelect);
                questionDiv.append(questionLabel, questionInput, optionDiv);
                $("#questions").append(questionDiv);
            });

        });
    </script>
</head>
<body>
    <h2>Add Questions</h2>
    <form action="process_questions.php" method="POST">
        <div id="questions">
            <div id="question1">
                <label>Question 1</label>
                <input type="text" name="question[]">

                <div id="options1">
                    <label>Options for Question 1</label>
                    <br>
                    <input type="text" name="options[1][]">
                    <br>
                    <input type="text" name="options[1][]">
                    <br>
                    <input type="text" name="options[1][]">
                    <br>
                    <label>Correct Answer</label>
                    <select name="correct_answer[]">
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                </div>
            </div>
        </div>

        <button id="addQuestion" type="button">Add Question</button>
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
