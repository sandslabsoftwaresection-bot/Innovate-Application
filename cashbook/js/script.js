





const monthElement = document.querySelector('.sands-month-name');
const daysElement = document.querySelector('.sands-days');
const prevMonthButton = document.querySelector('.sands-prev');
const nextMonthButton = document.querySelector('.sands-next');

// Get current date
const currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

// Event listeners for previous and next month buttons
prevMonthButton.addEventListener('click', showPreviousMonth);
nextMonthButton.addEventListener('click', showNextMonth);

// Initial call to display current month


function showCalendar(month, year) {
  

  const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

  // Clear existing calendar
  daysElement.innerHTML = '';

  // Display month name
  monthElement.textContent = `${monthNames[month]} ${year}`;

  // Get the first day of the month and the total number of days in the month
  const firstDay = new Date(year, month, 1).getDay();
  const totalDays = new Date(year, month + 1, 0).getDate();

  // Fill in the days
  for (let i = 0; i < firstDay; i++) {
    const li = document.createElement('li');
    li.textContent = '';
    daysElement.appendChild(li);
  }

  for (let i = 1; i <= totalDays; i++) {
    const li = document.createElement('li');
    li.textContent = i;
    const currentDateFormatted = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
    
	if (year === currentDate.getFullYear() && month === currentDate.getMonth() && i === currentDate.getDate()) {
      li.classList.add('sands-today');
    }
    const highlightedDate = highlightedDates.find(date => date[0] === currentDateFormatted);
    if (highlightedDate) {
      if (highlightedDate[1] === 0) {
        li.classList.add('sands-highlighted-multiple');
      } else {
		li.classList.add('sands-highlighted');
			 // Create a div element for the highlighted value
			  const div = document.createElement('div');
			  div.textContent = highlightedDate[1];
			  // Apply CSS styling to position the div in the top-right corner 
			  div.classList.add('sands-highlighted-value');
			  // Append the div to the list item
			  li.appendChild(div);
      }
    }
    daysElement.appendChild(li);
	
  }
   
}

// Add event listener for mouseover on the parent element
daysElement.addEventListener('mouseover', function(event) {
  const target = event.target;
  // Check if the mouseover event is triggered by a li element with the class sands-highlighted
  if (target.tagName === 'LI' && target.classList.contains('sands-highlighted')) {
    // Display tooltip or perform any desired action
    console.log('Mouse over sands-highlighted date:', target.textContent);
  }
  if (target.tagName === 'LI' && target.classList.contains('sands-highlighted-multiple')) {
    // Display tooltip or perform any desired action
    console.log('Mouse over sands-highlighted date:', target.textContent);
  }
});

function showPreviousMonth() {
  currentMonth--;
  if (currentMonth === -1) {
    currentMonth = 11;
    currentYear--;
  }
  showCalendar(currentMonth, currentYear);
}

function showNextMonth() {
  currentMonth++;
  if (currentMonth === 12) {
    currentMonth = 0;
    currentYear++;
  }
  showCalendar(currentMonth, currentYear);
}


function changeMonth(month) {
    const year = document.getElementById('sandsYearSelect').value;
    showCalendar(parseInt(month), parseInt(year));
}

function changeYear(year) {
    const month = document.getElementById('sandsMonthSelect').value;
	//console.log(month);
    showCalendar(parseInt(month), parseInt(year));
}

document.addEventListener('DOMContentLoaded', function() {
  var selectYear = document.getElementById('sandsYearSelect');
  for (var year = 1925; year <= 2100; year++) {
    var option = document.createElement('option');
    option.value = year;
    option.textContent = year;
    if (year === currentYear) { // Check if this is the current year
      option.selected = true; // Set this option as selected
    }
    selectYear.appendChild(option);
  }
});
document.addEventListener('DOMContentLoaded', function() {
  var selectMonth = document.getElementById('sandsMonthSelect');
  var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var currentMonth = new Date().getMonth(); // Get the current month (0-indexed)
  for (var i = 0; i < monthNames.length; i++) {
    var option = document.createElement('option');
    option.value = i;
    option.textContent = monthNames[i];
    if (i === currentMonth) { // Check if this is the current month
      option.selected = true; // Set this option as selected
    }
    selectMonth.appendChild(option);
  }
});





// Get all date cells
const dateCells = document.querySelectorAll('.days li');

let selectedDateCell = null;
let  selectedDateFromCalender ='';
// Attach click event listener to the container of date cells (daysElement)
daysElement.addEventListener('click', event => {
  const target = event.target;
  if (target.tagName === 'LI') {
    // Remove background color from previously selected date cell
    if (selectedDateCell) {
      selectedDateCell.style.backgroundColor = '';
    }

    // Get the text content of the clicked cell
    const cellContent = target.firstChild.textContent.trim();
    // Extract year and month information from the cell's text content
    const selectedYear = currentYear;
    const selectedMonth = currentMonth + 1; // Adding 1 since months are zero-based
    console.log(`Selected date: ${selectedYear}-${String(selectedMonth).padStart(2, '0')}-${String(cellContent).padStart(2, '0')}`);
	
	selectedDateFromCalender = `${selectedYear}-${String(selectedMonth).padStart(2, '0')}-${String(cellContent).padStart(2, '0')}`;
	
	var formattedDate = selectedDateFromCalender.split('-').join('/');
	load_cashbook_tbl(formattedDate,formattedDate);
	console.log("Formated "+formattedDate);
    // Set background color for the clicked cell
    target.style.backgroundColor = 'orange';
    // Update the selectedDateCell variable to store the currently selected cell
    selectedDateCell = target;
  }
});




