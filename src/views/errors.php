<body class="overflow-x-hidden bg-sky-300"></body>
<?php  require_once 'src/views/components/header.php';?>
    <div class="relative w-screen h-screen perspective-1 bg-gradient-to-b from-sky-900 to-sky-300">
        <div class="layer absolute inset-0 bg-[url('src/assets/c/5.png')] z-10 bg-fixed"></div>
        <div class="layer absolute inset-0 bg-[url('src/assets/c/4.png')] z-9 animated-image2"></div>
        <div class="layer absolute inset-0 bg-[url('src/assets/c/3.png')] z-8 bg-fixed animated-image"></div>
        <div class="layer absolute inset-0 bg-[url('src/assets/c/2.png')] z-7"></div>
        <div class="relative z-20 min-h-screen shape">
            <!-- Parallax Content goes here -->
            <div class="h-screen font flex items-center justify-center flex-col pb-48 "> <h3 class="text-black text-3xl">404 </h3>
            <h1 class="text-pink-500 text-6xl text_shadow font-bold mb-2">Error</h1>
            <button class="overflow-hidden relative w-36 p-2 h-12 bg-sky-300 black_border text-black border-none rounded-md text-lg font-bold cursor-pointer z-10 group mt-2"> <i class="fa-solid fa-arrow-right text-xl"></i>
  <span class="absolute w-40 h-32 -top-8 -left-2 bg-green-200 rotate-12 transform scale-x-0 group-hover:scale-x-100 transition-transform group-hover:duration-500 duration-1000 origin-right"></span>
  <span class="absolute w-40 h-32 -top-8 -left-2 bg-green-400 rotate-12 transform scale-x-0 group-hover:scale-x-100 transition-transform group-hover:duration-700 duration-700 origin-right"></span>
  <span class="absolute w-40 h-32 -top-8 -left-2 bg-green-800 rotate-12 transform scale-x-0 group-hover:scale-x-100 transition-transform group-hover:duration-1000 duration-500 origin-right"></span>
  <a class="link group-hover:opacity-100 group-hover:duration-1000 duration-100 opacity-0 absolute top-2.5 left-5 z-10 text_shadow text-center text-white" href="/">Go Back</a>
</button>

            </div>
           
        </div>
    </div>

    <?php  require_once 'src/views/components/footer.php';?>