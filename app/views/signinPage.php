<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <title>CURECO--Sign In</title>
</head>
<body>
    <main class="flex items-center justify-center h-screen bg-blue-300">

        <form method="POST" action="/cinehall/public/auth/signin" class="bg-white w-96 p-6 rounded shadow-sm">
                
                <?php if(!empty($data["em"])):?>
                    <div class="bg-red-500 px-3 py-2 rounded text-gray-100 mb-3">
                    <p><?=$data["em"]?></p>
                    </div>
                <?php endif?>
                
                <input 
                class="w-full py-2 bg-gray-100 text-gray-500 px-1 outline-none mb-4"
                name="ref" 
                type="text"
                placeholder="Ref" 
                />

                <button 
                id="login"
                class="bg-blue-500 w-full text-gray-100 py-2 rounded mb-4 hover:bg-blue-700 transition-colors">
                Log In</button>

                <button 
                type="button"
                onClick="location.href='#'" 
                class="bg-blue-500 w-full text-gray-100 py-2 rounded hover:bg-blue-700 transition-colors">
                Back</button>

            
        </form>

    </main>

</body>
</html>