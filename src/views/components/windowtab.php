 <!-- Toolbar with maximize, minimize, close buttons -->
  <style>
        .e {

            color: black;
            border: 2px solid #808080;
            border-left: 2px solid #ffffff;
            border-top: 2px solid #ffffff;
            box-shadow: inset 1px 1px 0 #ffffff, inset -1px -1px 0 #808080;
        }
  </style>
 <div class=" fixed top-6 bg-zinc-400 max-sm:w-[78%] lg:w-[89.5%] max-lg:w-[84%] pb-6 min-h-3 px-1 py-2 z-50 flex items-center justify-between"
            style="border-bottom: 3px solid black; box-shadow: 1px 1px 5px 5px rgba(0, 0, 0, 0.066);">
            <div class="name text-large font-extrabold font flex items-center justify-center ">
                <img src="../src/assets/c/logofull.png" class="w-full h-9">
                <h1><?php echo $name; ?></h1>
            </div>
            <div class="flex items-center px-2 gap-3">
                <button id="maximize" class="border group e black_border border-black px-3 py-1 rounded-md black_border bg-white"><i
                        class="fa fa-window-maximize group-hover:scale-110"></i>
                </button>
                <button id="shorter" class="border group e black_border border-black px-3 py-1 rounded-md black_border bg-white"><i
                        class="fa fa-window-restore group-hover:scale-110"></i>
                </button>
                <button id="cross" class="border group e black_border border-black px-3 py-1 rounded-md black_border bg-white"><i
                        class="fa fa-times group-hover:scale-110"></i>
                </button>
            </div>
        </div>