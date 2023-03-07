<?php include("./conn.php"); ?>
<?php 
    if(isset($_POST["submit"])){
        $leader_fname = $_POST["leader_fname"];
        $leader_lname = $_POST["leader_lname"];
        $leader_email = $_POST["leader_email"];
        $leader_contact = $_POST["leader_contact"];
        $member_fname_array = $_POST["fname"];
        $member_lname_array = $_POST["lname"];
        $member_email_array = $_POST["email"];
        $team_name = $_POST["title"];
        $count_of_members = $_POST["count"];
        $college = $_POST["college"];
        $domain = $_POST["domain"];
        if ((count($member_email_array)) != (count(array_unique($member_email_array))) || in_array($leader_email,array_unique($member_email_array))) {
            echo "<script> alert('Email Should be unique for every member');</script>";
    
        } else {

        $sql_leader = "insert into team_members (first_name, last_name, email, phone, is_leader) values ('$leader_fname', '$leader_lname', '$leader_email', '$leader_contact', 'yes')";
        $res_sql_leader = mysqli_query($conn, $sql_leader);
        $add_team = "insert into teams (team_name, college_name, member_email, domain) values ('$team_name', '$college', '$leader_email', '$domain')";
        $res = mysqli_query($conn, $add_team);

        for($i=0; $i<$count_of_members - 1; $i++){
            $fname = $member_fname_array[$i];
            $lname = $member_lname_array[$i];
            $email = $member_email_array[$i];
            $sql_member = "insert into team_members (first_name, last_name, email) values ('$fname', '$lname', '$email')";
            $res_sql_member = mysqli_query($conn, $sql_member);
            $add_team = "insert into teams (team_name, college_name, member_email, domain) values ('$team_name', '$college', '$email', '$domain')";
            $res = mysqli_query($conn, $add_team);
        }

        if($res){
            header("Location: index.php");
        }else{
            echo "something went wrong";
        }
    }
    }

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register For HackScript 4.0</title>
    <link rel="icon" type="image/x-icon" href="./images/apsit.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<style>

    </style>
<body>
    <div class="container  mt-5">
        <h2>Register For HackScript 4.0</h2>
        <hr>
        <form class="row needs-validation" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" novalidate>
            <div class="form-group row mb-3 mt-3">
                <div class="input-group col-md-6 col-xs-12">
                    <span class="input-group-text">Team Name</span>
                    <input id="team" type="text" name="title" class="form-control" required>
                    
                    <div class="invalid-feedback">
                            Please provide Team Name
                        </div>
                </div>
                <center><div id="team_check" style="margin-top: 2%; font-weight: bold;"></div></center>

            </div>
            <div class="form-group row mb-3 mt-3">
                <div class="col-xs-12">
                    <div class="input-group col-md-6 col-xs-12">
                        <span class="input-group-text">No of Members</span>
                        <select class="form-select" name="count" id="count" required>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-3 mt-3">
                <div class="col-xs-12">
                    <div class="input-group col-md-6 col-xs-12">
                        <span class="input-group-text">College Name</span>
                        <input type="text" class="form-control" id="validationCustom02" name="college" required>
                        <div class="invalid-feedback">
                            Please provide College Name
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-3 mt-3">
                <div class="col-xs-12">
                    <div class="input-group col-md-6 col-xs-12">
                        <span class="input-group-text">Domain</span>
                        <select class="form-select" name="domain" required>
                            <option>Smart Cities</option>
                            <option>Finance (FinTech)</option>
                        </select>
                    </div>
                </div>
            </div>

            <center><h3 class="m-4">Team Member 1 (Team Leader)</h3></center>
            <div class="col-md-6">
                <label for="validationCustom01" class="form-label">First name</label>
                <input type="text" class="form-control" id="validationCustom01" name="leader_fname" required>
                <div class="invalid-feedback">
                Please provide First Name
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustom02" class="form-label">Last name</label>
                <input type="text" class="form-control" id="validationCustom02" name="leader_lname" required>
                <div class="invalid-feedback">
                Please provide Last Name
                </div>
            </div>
            <div class="col-md-12 mt-2 mb-2">
                <label for="validationCustomUsername" class="form-label">Email</label>
                <div class="input-group has-validation">
                <input type="email" class="email form-control w-100" id="validationCustomUsername" name="leader_email" required>
                <center style="margin-top: 2%; font-weight: bold; text-align: center;"></center>
                <div class="invalid-feedback">
                    Please provide an Email.
                </div>
                </div>
            </div>
            <div class="col-md-12 mt-2 mb-2">
                <label for="validationCustom05" class="form-label">Contact</label>
                <input type="number" class="form-control" id="validationCustom05" name="leader_contact" required>
                <div class="invalid-feedback">
                Please provide a valid number.
                </div>
            </div>

            <div id="members" class="row col-md-12 mb-2">
                <center><h3 class="m-4">Team Member 2</h3></center>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">First name</label>
                    <input type="text" class="form-control" id="validationCustom01" name="fname[]" required>
                    <div class="invalid-feedback">
                    Please provide First Name
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="validationCustom02" name="lname[]" required>
                    <div class="invalid-feedback">
                    Please provide Last Name
                    </div>
                </div>
                <div class="col-md-12 mt-2 mb-2">
                    <label for="validationCustomUsername" class="form-label">Email</label>
                    <div class="input-group has-validation">
                    <input type="email" class="email form-control w-100" id="validationCustomUsername" name="email[]" required>
                    <center style="margin-top: 2%; font-weight: bold; text-align: center;"></center>
                    <div class="invalid-feedback">
                        Please provide an Email.
                    </div>
                    </div>
                </div>
            </div>
            <hr>
            
            <div class="form-group row">
            </div>
            <div class="form-group row mb-2">
                <div class="col-xs-12">
                    <button id="submit" type="submit" name="submit" class="w-100 btn btn-outline-info">Submit</button>
                </div>
            </div>
        </form>

        <hr>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        $('.email').on("input",function () {
            let curr = $(this);
            $.ajax({
                    type: "GET",
                    url:'get_email.php?email='+this.value,
                    success: function(response) {
                        response = JSON.parse(response);
                        curr.next().show();
                        curr.next().removeClass();
                        curr.next().text(response.msg);    
                        curr.next().addClass(response.color);
                        $("#submit").prop("disabled", response.disable);    
                    },      
                });
        });
        $('.email').blur(function () { 
            let curr = $(this);
            curr.next().hide();
        });

        $('#team').on("input",function () {
            let curr = $(this);
            $.ajax({
                    type: "GET",
                    url:'get_email.php?name='+this.value,
                    success: function(response) {
                        response = JSON.parse(response);
                        $("#team_check").show();
                        $("#team_check").removeClass();
                        $("#team_check").text(response.msg);    
                        $("#team_check").addClass(response.color);
                        $("#submit").prop("disabled", response.disable);    
                    },      
                });
        });
        $('#team').blur(function () { 
            let curr = $(this);
            $("#team_check").hide();
        });

        (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
        })()
        $(document).ready(function(){
            $("#count").on("change",function(){
                var numInputs = $(this).val();
                $('#members').html('');
                for(var i=1; i < numInputs; i++)
                {
                    var j = i+1;
                    // var $section =  $('<div class="form-group"><label for="" class="col-4 col-form-label">Company Name '+j+'</label><div class="col-6"><input type="text" name="companyname[]" class="form-control" required></div></div>');
                    var $section = $('<center><h3 class="m-4">Team Member '+j+'</h3></center><div class="col-md-6"><label for="validationCustom01" class="form-label">First name</label><input type="text" class="form-control" id="validationCustom01" name="fname[]" required><div class="invalid-feedback">Please provide First Name</div></div><div class="col-md-6"><label for="validationCustom02" class="form-label">Last name</label><input type="text" class="form-control" id="validationCustom02" name="lname[]" required><div class="invalid-feedback">Please provide Last Name</div></div><div class="col-md-12 mt-2 mb-2"><label for="validationCustomUsername" class="form-label">Email</label><div class="input-group has-validation"><input type="email" class="form-control" id="validationCustomUsername" name="email[]" required><div class="invalid-feedback">Please provide an Email.</div></div></div>')
                    $('#members').append($section);
                }
        });
    });
    </script>
</body>

</html>