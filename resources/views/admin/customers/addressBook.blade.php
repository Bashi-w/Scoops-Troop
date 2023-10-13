@extends('layouts.admin')

@section('content')

<style>
      .main-container{
    display: grid;
    grid-template-columns: 1fr 2fr;
    grid-gap: 15px;
    border-radius: 20px;
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
  }

  .customers,.details{
    background: #ffffff; 
    padding:2em;
    overflow-y:scroll;
  }

  .customers{
    height:80vh;
  }
  .details{
    min-height:20em;
  }

  .customers table{
    cursor: pointer;
  }
   /* Style for the search input container */
   .search-container {
    display: flex;
    align-items: center;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
  }

  /* Style for the search icon */
  .search-icon {
    padding: 5px;
    color: #999; /* Adjust the color as needed */
  }

  /* Style for the search input field */
  .search-input {
    border: none;
    outline: none;
    width: 100%;
    padding: 5px;
  }

  table.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }

  table.table th {
    background-color: #f0f0f0;
    padding: 10px;
    text-align: left;
  }

  table.table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }
  
</style>
<div class="main-container">
    <div class="customers">
        <div class="search-container">
            <span class="search-icon"><i class="fas fa-search"></i></span> <!-- You can use any search icon library or image here -->
            <input type="text" name="search" id="search" placeholder="Search customer" class="search-input" onfocus="this.value=''" />
        </div>
        <div id="search_list"></div>

    </div>
    <div class="details">
        <p>Click on a customer to view details</p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
    // Load all customers when the page loads
    loadCustomers();

    // Use event delegation to handle click events for dynamically added elements
    $('.customers').on('click', '.user-row', function () {
        console.log('works');
        // Get the user ID from the data attribute
        var userId = $(this).data('user-id');
        console.log(userId);

        // Fetch user details by user ID
        fetchUserDetails(userId);
    });

    $('#search').on('keyup', function () {
        var query = $(this).val();
        if (query === '') {
            // If the search input is empty, reload all customers
            loadCustomers();
        } else {
            // Perform the search
            searchCustomers(query);
        }
    });

    function loadCustomers() {
        $.ajax({
            url: "search",
            type: "GET",
            success: function (data) {
                $('#search_list').html(data);
            }
        });
    }

    function searchCustomers(query) {
        $.ajax({
            url: "search",
            type: "GET",
            data: {
                'search': query
            },
            success: function (data) {
                $('#search_list').html(data);
            }
        });
    }

    function fetchUserDetails(userId) {
        // Make an AJAX request to fetch user details by user ID
        $.ajax({
            url: "users/" + userId, // Adjust the URL to your route
            type: "GET",
            success: function (data) {
                // Update the details div with the fetched user details
                $('.details').html(data);
            }
        });
    }
});


</script>
@endsection