<?php include('partial/menu.php') ?>
<!-- Main content section start -->
<html>
    <head>

<style>
.tbl-full{
    width:100%;
}
.tbl-full tr th{
    border-bottom:1px solid black;
    padding:1%;
    text-align:left
}

table tr td{
    padding:1%; 
}
.btn-secondary{
    background-color:#7bed9f; 
    padding:1%;
    color:black;
    text-decoration:none;
    font-weight:bold; 
}
.btn-secondary:hover{
    background-color:#2ed573
}
.btn-denger{
    background-color:#ff6b81; 
    padding:1%;
    color:white;
    text-decoration:none;
    font-weight:bold; 
}
.btn-denger:hover{
    background-color:#ff4757
}
</style>
</head> 
<body>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Oeder</h1> 
        <br/>
 <table class="tbl-full">
     <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>User name</th>
        <th>Action</th>  
    </tr>
    <tr>
        <td>1.</td>
        <td>fenil</td>
        <td>fenil</td>
        <td><a href="#" class="btn-secondary">Update Admin</a>
        <a href="#" class="btn-denger">Delete Admin</a></td>
    </tr>
    <tr>
        <td>1.</td>
        <td>fenil</td>
        <td>fenil</td>
        <td>update admin</td>
    </tr>
    <tr>
        <td>1.</td>
        <td>fenil</td>
        <td>fenil</td>
        <td>update admin</td>
    </tr>
    <tr>
        <td>1.</td>
        <td>fenil</td>
        <td>fenil</td>
        <td>update admin</td>
    </tr>
 </table>
    </div>


</div>

<!-- Main content section end -->
<?php include('partial/footer.php') ?>
</body>
</html>