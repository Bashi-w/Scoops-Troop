@extends('layouts.admin')

@section('content')
<style>
       .table-stocks {
    padding: 20px;
    border-radius: 20px;
    width: 100%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: white;
    /* margin-bottom: 20px; Reduce or remove this line */
}


  .stocks {
    display: grid;
    grid-template-columns: 2fr 1fr;
    grid-gap: 2em;
    height:fit-content;
    /* min-height: 20em; Remove this line */
}


  .lowstock{
    padding: 20px;
    border-radius: 20px;
    width: 100%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color:white;
    max-height:100%;
    overflow-y:scroll;
  }
  .icon-container {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center horizontally */
    justify-content: center; /* Center vertically */
    text-align: center; /* Center text within the container */
}

</style>
<h3><b>Stock Levels for {{$branch->location}} Branch</b></h3>
<br>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Add New
</button>
<br><br>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('admin.addStock') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
                <div class="mb-3">
                        <label for="product" class="form-label">Product</label>
                        <select class="form-control" data-live-search="true" name="product" required>
                            @foreach($productsNotInStock as $productsNotInStock)
                            <option value="{{$productsNotInStock->id}}">{{$productsNotInStock->name}}</option>
                           
                            @endforeach
                            <!-- Add more options as needed -->
                        </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" min=1 class="form-control" name="quantity" id="exampleFormControlInput1" placeholder="Enter Quantity" required>
                </div>                  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    </div>
  </div>
</div>

<div class="stocks">
  <div class="table-stocks">
      <table class="table table-striped">
          <thead>
              <tr>
                  <th scope="col">Product ID</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Quantity (Units)</th>
              </tr>
          </thead>
          <tbody>
              @foreach($stocks as $stock)
                  <tr>
                      <td>{{$stock->product_id}}</td>
                      <td>{{$stock->product_name}}</td>
                      <td>{{$stock->quantity}}</td>
                      <td>
                          <i  class="bx bx-pencil bounce-icon" style="color: #449e3d; font-size: 24px; cursor: pointer;" onclick="openEditModal({{ $stock->id }},{{$stock->quantity}})"></i>
                      </td>
                      <td><a href="{{url('/admin/stock/delete',$stock->id)}}"> <i class="bx bx-trash bounce-icon" style="color: #FF0000; font-size: 24px;"  onclick="confirmDelete(event)" ></i></a></td>
                      
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
  <div class="lowstock">
  <div class="icon-container">
        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
        <lord-icon
            src="https://cdn.lordicon.com/wdqztrtx.json"
            trigger="hover"
            colors="primary:#121331"
            style="width:100px;height:100px">
        </lord-icon>
        <h4><b>Low Stock</b></h4>
    </div>
  @foreach($lowStockProducts as $lowStockProduct)
  <p>{{$lowStockProduct->name}}</p>
  @endforeach

  @foreach($notInStock as $notInStock)
  <p>{{$notInStock->name}}</p>
  @endforeach
</div>
</div>





<!-- Edit Modal -->
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Quantity</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.editStock') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_quantity" class="form-label">New Quantity</label>
                        <input type="number" min=1 class="form-control" name="stockQuantity" id="edit_quantity"
                            placeholder="Enter New Quantity" required>
                        <input type="hidden" name="stockid" id="stockid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<h3><b>Stock Distribution</b></h3>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    // Function to generate a random HEX color code
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    const productColors = {!! json_encode($productColors) !!}; // Array of product names

    // Generate random colors for each product if not provided
    for (let i = 0; i < productColors.length; i++) {
        if (!productColors[i]) {
            productColors[i] = getRandomColor();
        }
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($productNames) !!}, // Convert PHP array to JavaScript array
            datasets: [{
                label: 'Stock Levels',
                data: {!! json_encode($quantities) !!}, // Convert PHP array to JavaScript array
                backgroundColor: productColors, // Assign random colors to each bar
                borderWidth: 1,
            }],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                legend: {
                    display: false, // Set display to false to hide the legend
                },
            },
        },
    });
</script>






<script>
    function openEditModal(itemId, quantity) {
        // Set the value of the input field in the edit modal
        document.getElementById('edit_quantity').value = quantity;
        document.getElementById('stockid').value = itemId;
        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }

   

    function confirmDelete(event) {
    event.preventDefault();

    // Show the alert dialog
    if (confirm("Are you sure you want to delete this?")) {
      // If the user clicks OK, proceed with the deletion
      window.location.href = event.target.parentElement.href;

      // Display a success message
      showSuccessMessage();
    }
  }

  // Function to show the success message
  function showSuccessMessage() {
    // You can customize the success message here
    alert("Deletion was successful!");
  }
</script>


@endsection