<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            color: #555;
        }

        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .alert {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 4px;
        }

    </style>
</head>
<body>

    <div class="container">
        <!-- عرض رسالة النجاح -->
        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <h1>Facebook Bill Upload</h1>

        <!-- نموذج رفع الملف -->
        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="file">Choose a file to upload:</label>
            <input type="file" name="file" id="file">
            
            <label for="user_name">Choose a name:</label>
            <select name="user_name" id="user_name">
                <option value="Mr. Tamer">Mr. Tamer</option>
                <option value="Mr. Ayman">Mr. Ayman</option>
                <option value="Mr. Sherif">Mr. Sherif</option>
                <option value="System">System</option>
            </select>
            <button type="submit">Upload</button>
        </form>
    </div>

    

</body>
</html>
