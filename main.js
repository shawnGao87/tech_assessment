const toggleTask = e => {
	const complete = $(e.target).prop("checked");
	const checkboxTd = $(e.target).parent();
	const tCompletedTd = checkboxTd.prev();
	const taskNameTd = tCompletedTd.prev();

	if (complete) {
		taskNameTd.css("text-decoration", "line-through");
		// using Moment library to handle the datetime and format
		tCompletedTd.html(moment().format("MMM DD, YYYY, hh:mm A"));
	} else {
		taskNameTd.css("text-decoration", "none");

		tCompletedTd.html("");
	}
};

const addTodo = () => {
	const input = $("#myInput").val();

	// trimming down all white spaces. if length > 0 then valid input

	if (input.replace(/\s/g, "").length <= 0) {
		alert("Please enter your task.");
	} else {
		// template literal, doesn't work with IE
		const element = `<tr class="row">
			<td>${input}</td>
			<td class="t_completed"></td>
			<td class="item_complete"><input onclick="toggleTask(event)" type="checkbox" /></td>
		</tr>
		`;

		$("#todo").append(element);
	}

	$("#myInput").val("");
};

$(document).ready(function() {
	$("button").on("click", addTodo);

	$(".item_complete input").on("click", toggleTask);

	$("#myInput").on("keypress", e => {
		e.which == 13 && addTodo();
	});
});
