<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Pills Navigation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .nav-pills {
            background: linear-gradient(#CC0001, #800000);
            border-radius: 50px;
            padding: 5px;
        }

        .nav-pills .nav-link {
            color: white;
            font-weight: bold;
            border-radius: 50px;
        }

        .nav-pills .nav-link.active {
            background-color: #00C0C1;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Data Source</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Setting Parameter</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Preview</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-ulala-tab" data-bs-toggle="pill" data-bs-target="#pills-ulala" type="button" role="tab" aria-controls="pills-ulala" aria-selected="false">Result</button>
            </li>
        </ul>

        <div class="tab-content mt-3" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">Profile Content</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">Contact Content</div>
            <div class="tab-pane fade" id="pills-ulala" role="tabpanel" aria-labelledby="pills-ulala-tab">Ulala Content</div>
        </div>
    </div>
</body>
</html>
