<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Gate Keeper Admin</a>
        </nav>
		<div class="container">
			<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add User</button> <br><br>
            <div class="row">
								<table class="table table-dark">
									<thead>
											<th>Username</th>
											<th>Password</th>
									</thead>
									<tbody id="users">
									</tbody>
								</table>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <input class="form-control" type="text" placeholder="username" id="username"/>
                      </div>

                       <div class="form-group">
                          <input class="form-control" type="text" placeholder="password" id="password"/>
                      </div>

                      <div class="form-group">
                          <button class="btn btn-primary" onclick="createUser()" data-dismiss="modal">Save User</button>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
	</body>

	<script>
		getUser();
		function createUser()
		{

			$.ajax({
				url: 'user.php',
				type: 'post',
				data: { "createUser": "1","username" : $('#username').val(),"password" : $('#password').val()},
				success: function(response)
				{
					 Swal.fire({
							  title: 'Gate Keeper',
							  text: "Sucessfully Added",
							  icon: 'success',
							  confirmButtonColor: '#3085d6',
							  confirmButtonText: 'OK'
							}).then((result) => {
							  if (result.value) {
							    document.location.href = "admin.php"
							  }
							})
				}
			});
		}
	function getUser()
    {
            $.ajax({
					 url: 'user.php',
					 type: 'post',
					 data: { "getUser": "1"},
					 success: function(response)
					 {
                         var obj = JSON.parse(response)
                         obj.forEach(user => {
                             var btn = "<div/>";
							
							 var trValue = "<tr>"+
				                         	  	"<td><input  value='test' id='xusername'/></td>"+
				                         	  	"<td><input  value='test' id='xpassword'/></td>"+
											"</tr>"

							document.querySelector('#users').insertAdjacentHTML(
                        	'afterbegin',
                       		 btn + trValue +
	                          `</div>`
                      )

                             $("#xusername").val(user.username)
                             $("#xpassword").val(user.password)


                         })
					 }
			 });
    }
    
	</script>
</html>
