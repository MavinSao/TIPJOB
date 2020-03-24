$(document).ready(() => {
    $(".edit-question").click(function() {
        var $row = $(this).closest("tr"); // Find the row
        var $id = $row.find(".id").text(); //Find id
        var $question = $row.find(".question").text(); //Find question
        // Let's test it out

        $("#update-id").val($id)
        $("#update-question").val($question)
    });

    $(".edit-answer").click(function() {
        var $row = $(this).closest("tr"); // Find the row
        var $id = $row.find(".id").text(); // Find the id
        var $qid = $row.find(".qid").text(); // Find the id
        var $answer = $row.find(".answer").text(); //Find answer
        console.log("question id :" + $qid)
        console.log("answer id :" + $id)
        console.log("answer :" + $answer)
            // Let's test it out
        $("#update-qid").val($qid)
        $("#update-id").val($id)
        $("#update-answer").val($answer)

    });

    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    $(".create-date").val(date);

    console.log(date);

    // $qid = $("#question-id").text();
    // console.log($qid)
    // $("#qid").val($qid)

})