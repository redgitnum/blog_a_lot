@extends('_layouts.app')
@section('content')
    <div class="flex flex-col items-center flex-grow">
        <div class="w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 flex p-1 
        font-mono text-gray-600 text-sm mt-3 mb-1">
            <a href="" class="pl-3 pr-6 font-bold">latest</a>&#183;
            <a href="" class="px-6">most viewed</a>&#183;
            <a href="" class="px-6">most votes</a>
        </div>
        <div class="w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12  p-3">
            <div class="w-full bg-white shadow rounded-md border-gray-400 mb-4">
                <div class="text-lg text-gray-500 flex items-center justify-between">
                    <div class="border-r px-2 my-2 text-sm text-center text-gray-600">
                        15 votes
                    </div>
                    <div class="w-full px-2 my-2">
                        <div class="text-indigo-900">Posted by {author} on {timestamp}</div>
                        <div class="text-xs uppercase"> in {categories}</div>
                    </div>
                    <div class="w-24 px-2 my-2 uppercase text-gray-700 border-l  text-xs">18 mins ago</div>
                </div>
                <div class="py-4 mx-6 max-h-60 overflow-hidden border-t">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, eius aperiam doloremque maxime libero facere maiores minima dicta, quidem labore amet quaerat assumenda, molestias dolorum consectetur exercitationem nesciunt adipisci minus?
                    Eaque accusamus obcaecati numquam saepe aliquid odio dicta doloribus officiis. Labore pariatur consectetur perferendis architecto accusamus voluptates, ipsam numquam quaerat sit quas, molestias nisi, fugit in molestiae nemo harum facere.
                    Molestiae suscipit, delectus, fugiat natus provident sapiente deserunt in ex repellendus eius cum! Dolores pariatur, animi voluptates voluptas illum culpa vitae? Nobis error rem at, magni doloribus tenetur quo. Odit.
                    Consequatur sapiente id laudantium repudiandae quae, placeat, odit nemo repellat alias porro consequuntur vel esse libero, maxime necessitatibus optio rerum harum fugit quod ea dignissimos soluta velit quia. Iste, cumque?
                    Praesentium, numquam recusandae quisquam ipsa sequi porro, ea, repellat perferendis distinctio atque libero itaque nulla! Temporibus non tempore blanditiis magni ut voluptate in saepe at quae modi iusto, veniam animi.
                    Laborum harum eum architecto aperiam debitis repudiandae quam laboriosam doloremque culpa aliquam, optio eius dolore nemo molestias quaerat odio obcaecati corporis necessitatibus ea tempora molestiae dignissimos mollitia? Tenetur, error aperiam.
                    Nulla totam veritatis dolorem similique cum ad quia, magnam rerum sequi nesciunt neque vero cumque ipsum quibusdam eum autem recusandae perspiciatis aliquam nisi. Recusandae vero doloremque sapiente nihil repudiandae id.
                    Adipisci delectus nihil dicta quod suscipit labore eligendi? Fugit reprehenderit quo, culpa consequuntur rem adipisci mollitia, vel distinctio hic repudiandae nihil, animi voluptas. Est, molestias officiis veritatis itaque eveniet reprehenderit.
                    Nostrum temporibus reprehenderit quisquam ullam mollitia inventore laboriosam a nobis sint, dolor itaque, quas assumenda exercitationem saepe, voluptatem cumque reiciendis repudiandae iusto. Molestias pariatur rerum ipsa quaerat, eligendi tenetur ad.
                    Beatae consequuntur similique non magnam esse, repellat officia explicabo eos expedita ducimus incidunt neque voluptate, aut ea ullam voluptatem porro adipisci, quaerat ad omnis animi laudantium excepturi sed? Eaque, eos!
                </div>
                <div class="border-t mx-6 py-4 flex justify-between items-center">
                    <div class="text-gray-500 font-mono">
                        0 Comments 
                    </div>
                    <div class="text-sm uppercase font-mono text-gray-600 ">
                        continue reading>>
                    </div>
                </div>
            </div>
            <div class="w-full bg-white shadow rounded-md border-gray-400 mb-4">
                <div class="text-lg text-gray-500 flex items-center justify-between">
                    <div class="border-r px-2 my-2 text-sm text-center text-gray-600">
                        15 votes
                    </div>
                    <div class="w-full px-2 my-2">
                        <div class="text-indigo-900">Posted by {author} on {timestamp}</div>
                        <div class="text-xs uppercase"> in {categories}</div>
                    </div>
                    <div class="w-24 px-2 my-2 uppercase text-gray-700 border-l  text-xs">18 mins ago</div>
                </div>
                <div class="py-4 mx-6 max-h-60 overflow-hidden border-t">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, eius aperiam doloremque maxime libero facere maiores minima dicta, quidem labore amet quaerat assumenda, molestias dolorum consectetur exercitationem nesciunt adipisci minus?
                    Eaque accusamus obcaecati numquam saepe aliquid odio dicta doloribus officiis. Labore pariatur consectetur perferendis architecto accusamus voluptates, ipsam numquam quaerat sit quas, molestias nisi, fugit in molestiae nemo harum facere.
                    Molestiae suscipit, delectus, fugiat natus provident sapiente deserunt in ex repellendus eius cum! Dolores pariatur, animi voluptates voluptas illum culpa vitae? Nobis error rem at, magni doloribus tenetur quo. Odit.
                    Consequatur sapiente id laudantium repudiandae quae, placeat, odit nemo repellat alias porro consequuntur vel esse libero, maxime necessitatibus optio rerum harum fugit quod ea dignissimos soluta velit quia. Iste, cumque?
                    Praesentium, numquam recusandae quisquam ipsa sequi porro, ea, repellat perferendis distinctio atque libero itaque nulla! Temporibus non tempore blanditiis magni ut voluptate in saepe at quae modi iusto, veniam animi.
                    Laborum harum eum architecto aperiam debitis repudiandae quam laboriosam doloremque culpa aliquam, optio eius dolore nemo molestias quaerat odio obcaecati corporis necessitatibus ea tempora molestiae dignissimos mollitia? Tenetur, error aperiam.
                    Nulla totam veritatis dolorem similique cum ad quia, magnam rerum sequi nesciunt neque vero cumque ipsum quibusdam eum autem recusandae perspiciatis aliquam nisi. Recusandae vero doloremque sapiente nihil repudiandae id.
                    Adipisci delectus nihil dicta quod suscipit labore eligendi? Fugit reprehenderit quo, culpa consequuntur rem adipisci mollitia, vel distinctio hic repudiandae nihil, animi voluptas. Est, molestias officiis veritatis itaque eveniet reprehenderit.
                    Nostrum temporibus reprehenderit quisquam ullam mollitia inventore laboriosam a nobis sint, dolor itaque, quas assumenda exercitationem saepe, voluptatem cumque reiciendis repudiandae iusto. Molestias pariatur rerum ipsa quaerat, eligendi tenetur ad.
                    Beatae consequuntur similique non magnam esse, repellat officia explicabo eos expedita ducimus incidunt neque voluptate, aut ea ullam voluptatem porro adipisci, quaerat ad omnis animi laudantium excepturi sed? Eaque, eos!
                </div>
                <div class="border-t mx-6 py-4 flex justify-between items-center">
                    <div class="text-gray-500 font-mono">
                        0 Comments 
                    </div>
                    <div class="text-sm uppercase font-mono text-gray-600 ">
                        continue reading>>
                    </div>
                </div>
            </div>
            <div class="w-full bg-white shadow rounded-md border-gray-400 mb-4">
                <div class="text-lg text-gray-500 flex items-center justify-between">
                    <div class="border-r px-2 my-2 text-sm text-center text-gray-600">
                        15 votes
                    </div>
                    <div class="w-full px-2 my-2">
                        <div class="text-indigo-900">Posted by {author} on {timestamp}</div>
                        <div class="text-xs uppercase"> in {categories}</div>
                    </div>
                    <div class="w-24 px-2 my-2 uppercase text-gray-700 border-l  text-xs">18 mins ago</div>
                </div>
                <div class="py-4 mx-6 max-h-60 overflow-hidden border-t">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, eius aperiam doloremque maxime libero facere maiores minima dicta, quidem labore amet quaerat assumenda, molestias dolorum consectetur exercitationem nesciunt adipisci minus?
                    Eaque accusamus obcaecati numquam saepe aliquid odio dicta doloribus officiis. Labore pariatur consectetur perferendis architecto accusamus voluptates, ipsam numquam quaerat sit quas, molestias nisi, fugit in molestiae nemo harum facere.
                    Molestiae suscipit, delectus, fugiat natus provident sapiente deserunt in ex repellendus eius cum! Dolores pariatur, animi voluptates voluptas illum culpa vitae? Nobis error rem at, magni doloribus tenetur quo. Odit.
                    Consequatur sapiente id laudantium repudiandae quae, placeat, odit nemo repellat alias porro consequuntur vel esse libero, maxime necessitatibus optio rerum harum fugit quod ea dignissimos soluta velit quia. Iste, cumque?
                    Praesentium, numquam recusandae quisquam ipsa sequi porro, ea, repellat perferendis distinctio atque libero itaque nulla! Temporibus non tempore blanditiis magni ut voluptate in saepe at quae modi iusto, veniam animi.
                    Laborum harum eum architecto aperiam debitis repudiandae quam laboriosam doloremque culpa aliquam, optio eius dolore nemo molestias quaerat odio obcaecati corporis necessitatibus ea tempora molestiae dignissimos mollitia? Tenetur, error aperiam.
                    Nulla totam veritatis dolorem similique cum ad quia, magnam rerum sequi nesciunt neque vero cumque ipsum quibusdam eum autem recusandae perspiciatis aliquam nisi. Recusandae vero doloremque sapiente nihil repudiandae id.
                    Adipisci delectus nihil dicta quod suscipit labore eligendi? Fugit reprehenderit quo, culpa consequuntur rem adipisci mollitia, vel distinctio hic repudiandae nihil, animi voluptas. Est, molestias officiis veritatis itaque eveniet reprehenderit.
                    Nostrum temporibus reprehenderit quisquam ullam mollitia inventore laboriosam a nobis sint, dolor itaque, quas assumenda exercitationem saepe, voluptatem cumque reiciendis repudiandae iusto. Molestias pariatur rerum ipsa quaerat, eligendi tenetur ad.
                    Beatae consequuntur similique non magnam esse, repellat officia explicabo eos expedita ducimus incidunt neque voluptate, aut ea ullam voluptatem porro adipisci, quaerat ad omnis animi laudantium excepturi sed? Eaque, eos!
                </div>
                <div class="border-t mx-6 py-4 flex justify-between items-center">
                    <div class="text-gray-500 font-mono">
                        0 Comments 
                    </div>
                    <div class="text-sm uppercase font-mono text-gray-600 ">
                        continue reading>>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection