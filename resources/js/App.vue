<template>
    <div

    style="background-image: url(https://images.unsplash.com/photo-1507925921958-8a62f3d1a50d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8dG8lMjBkbyUyMGxpc3R8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60)"
    class=" py-2


    font-serif
    text-4xl
    italic
    font-semibold tracking-wide
    text-violet-800
    grid justify-items-center"

    >
    <h1
    class="mb-20 box-decoration-slice  bg-orange-100  text-voilet-200 px-2 rounded  " >To Do list that I won't Do :v</h1>
    </div>

    <div

    class="
    grid justify-items-center "
    >


    <table class="w-[80%] my-8 border border-slate-500 ">
        <tr class="w-full border border-slate-500 font-sans">
            <th class="w-[15%] border border-slate-500 font-serif text-2xl  text-violet-800">task number </th>
            <th class="w-[40%] border border-slate-500 font-serif text-2xl  text-violet-800">task name </th>
            <th class="w-[20%] border border-slate-500 font-serif text-2xl  text-violet-800">Done? </th>

        </tr>

        <tr
        v-for="task in tasks"
        class=" border border-slate-500 ">
               <td class="grid justify-items-center p-4 text-xl ">{{ task.id }}</td>
               <td class=" border border-slate-500 px-6 text-xl text-center  ">{{ task.name }}</td>
               <td class="border border-slate-500 px-6 text-xl text-center">{{ ( task.done == 0)? "Not Done":"Done"}}</td>
               <td>
                <div class="flex justify-center">

                    <button class="bg-red-600 hover:bg-gray-600 text-bold rounded-full py-2 px-4 text-white" @click="deleteTask(task.id)">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Delete
                    </button>
                    <button class="bg-btn hover:bg-green-600 text-bold rounded-full py-2 px-6 text-white ml-6" @click="deleteTask(task.id)">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </button>


                </div>
                </td>
        </tr>


        <tr v-if="adding_new_task">
            <td class="border border-slate-500 px-5 "></td>
            <td class="border border-slate-500 px-5"><input type="text" v-model="new_task_name"/></td>
            <td class="border border-slate-500 px-5"></td>

        </tr>
    </table>


    <div class="flex justify-center " >
    <button class=" bg-violet-500 hover:bg-violet-700  text-white text-xl font-bold py-3 px-6 rounded-full"
    @click="adding_new_task=true;"
    >
        add new task
    </button>

    <button class=" bg-green-500 hover:bg-green-700 text-white text-xl font-bold py-3 px-6 rounded-full ml-10"
    @click="confirmAddTask"
    v-if="adding_new_task"
    >
        Confirm
    </button>




</div>

</div>

<!-- this is just an example of swaping between two photos
<div class="photo-container  flex justify-center">
    <PhotoSwap
        class="photo-swap-item "
        firstPhotoSrc="/photos/first.jpg"
        firstPhotoAlt="First Photo"
        secondPhotoSrc="/photos/second.jpg"
        secondPhotoAlt="Second Photo"
    />
    <PhotoSwap
        class="photo-swap-item "
        firstPhotoSrc="/photos/first1.jpg"
        firstPhotoAlt="First Photo"
        secondPhotoSrc="/photos/second1.jpg"
        secondPhotoAlt="Second Photo"
    />


  </div>
  -->

</template>
<script>

    //import PhotoSwap from "./PhotoSwap.vue";  here we using the photoswap.vu         //
    export default {

        data(){
            return{
                tasks: [],
                adding_new_task: false,
                new_task_name:'',
                //showSecondPhoto: false,        for swaping the photos

                };

            },


        mounted(){
            axios
            .get('/api/get_tasks')
            .then( (response) => {
                this.tasks = response.data;

            }
        )
        },

         /* For swapping the photos
            components: {

                PhotoSwap,

            },
                */


        methods:{

            deleteTask(id) {
             axios
             .delete(`/api/delete_task/${id}`)
            .then(response => {
                // Handle the response as needed
                console.log(response.data);
                // Refresh the tasks or perform any necessary updates
            })
            .catch(error => {
                // Handle any error that occurred during the request
                console.error(error);

            });
            location.reload();
    },

            confirmAddTask(){
               let data = {
                "name": this.new_task_name,


               };


               axios
                    .post('/api/add_task', data)
                    .then(response => {
                        if (response.data.success) {
                        let new_task = response.data.new_task;
                        this.tasks.push(new_task);
                        this.adding_new_task = false;
                        this.new_task_name = '';
                        }
                    });
                    location.reload();

            }



        }


    }



</script>
