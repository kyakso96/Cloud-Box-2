
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery.js"></script>
    <title>Cloud Computing Application</title>
</head>
<body>
<div class= "navbar">
    <div class="logo">
        CLOUD-BOX
    </div>
    <div class="nav-right">

        <a href="loggedin.php">Home</a>

        <a href="view-files.php">View Files</a>

        <a href="logout.php">Log Out</a>

    </div>
</div>
<br>
<br>
<div class="container" style="opacity: 0.9;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" align="center">Upload</h3>
        </div>
        <div class="panel-body">
            <form action="" name="form" method="post" enctype="multipart/form-data"> <!-- form to upload files into the biucket -->
                <div class="form-group">
                    <input type="file" name="file" id="file" /></td>

                </div>
                <div class="form-group">
                    <button type="submit"  name="submit" id="submit">Upload </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container" style="opacity: 0.9;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" align="center">File List</h3>
        </div>
        <div class="panel-body">
            <!-- list of table where the uploaded files are shown -->
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                <thead>
                <tr>
                    <th width="90%" align="center">Files</th>
                    <th align="center">Download</th>
                    <th align="center">Delete</th>
                </tr>
                </thead>
                                    <tr>
                        <td>
                            &nbsp;git.txt                        </td>
                        <td>
                            <button class="alert-success"><a href="download.php?filename=git.txt&f=20210416224147_git.txt">Download</a></button>
                        </td>
                        <td>
                            <button class="alert-success"><a href="?delete=8">Delete</a></button>
                        </td>
                    </tr>
                            </table>
        </div>
    </div>
</div>
</body>
</html>