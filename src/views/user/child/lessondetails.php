
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Child Lessons</title>
        <link rel="shortcut icon" href="src/assets/c/logofull.png" type="image/x-icon">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
              integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/src/assets/css/style.css">
    </head>
    <body class="overflow-hidden w-screen h-screen bg-sky-300">
        
    
        
    <div class="border border_black bg-yellow-200 font-mono top-5 overflow-hidden h-[88%] max-sm:w-[78%] lg:w-[90%] max-lg:w-[86%] absolute right-5 rounded-md black_border">
    <div class="border-zinc-400 border-4">
                <?php $name = $child['name']; ?>
                <?php require 'src\views\components\windowtab.php'; ?>
    
                  <!-- Content Area with Overflow Scroll -->
                <div class="mt-[52px] pt-10 overflow-y-scroll h-screen w-full pl-4">
                <div class="flex items-center justify-between">
                <h1 class="font text-4xl text-pink-500 font-semibold mb-7 text_shadow"> <?php echo $lessonDetails["title"]; ?></h1>  
                <h4 class="font-mono text-2xl self-start  text-pink-500 font-semibold mb-7 mr-4">Subject: <?php echo $lessonDetails["subject_name"]; ?></h4>  
            </div>      <!-- End of container -->
             <div class="flex"> 
                <div class="w-9/12 h-[65vh] border rounded-md ">
                    <iframe class="w-full h-full rounded-md" src="<?php echo $lessonDetails["video_url"]; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen frameborder="0"></iframe>
                </div>
            <div class="w-3/12  h-[65vh] p-2 ">
              <h1 class="font text-purple-500 text-xl font-extrabold">  Lesson Contents</h1>
    
            </div>
            <form method="POST" action="/child/dashboard/<?php echo $childId; ?>/lesson/<?php echo $lessonDetails['id']?>/complete">
          <input type="hidden" name="child_id" value="<?php echo $childId; ?>"> <!-- Replace with actual child ID -->
          <input type="hidden" name="lesson_id" value="<?php echo $lessonDetails['id']?>"> <!-- Replace with actual lesson ID -->
        <button type="submit" class="bg-purple-500 float-right mt-[-3rem] mr-2 border-l-gray-200 border-t-white border hover:bg-indigo-900 text-white font-bold rounded-md py-2 px-4 font black_border" >Complete </button>
       
    </form></div>
            </div>
            </div> <!-- End of border-gray-400 -->
        </div> <!-- End of bg-yellow-200 -->
    
        <!-- Include custom scripts -->
        <script src="/src/assets/js/script.js"></script>
    
        <?php require 'src\views\user\child\components\taskbar.php'; ?>
        <script>
            // Function to get a cookie by name
            function getCookie(name) {
                let value = "; " + document.cookie;
                let parts = value.split("; " + name + "=");
                if (parts.length === 2) return parts.pop().split(";").shift();
            }
    
            // Check for the lesson_status cookie
            const status = getCookie('lesson_status');
            if (status) {
                if (status === 'completed') {
                    alert('Lesson marked as completed successfully.');
                } else if (status === 'failed') {
                    alert('Failed to mark lesson as completed. Please try again.');
                }
    
                // Clear the cookie after showing the alert
                document.cookie = 'lesson_status=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            }
        </script>
    
    </body>
    </html>
    
