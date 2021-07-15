<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                TODO APP | {{ userName }}
            </h2>
        </template>

        <div class="relative w-full mx-auto md:w-1/2 mt-5 p-3 space-y-3">
            <div v-if="isOpen" @click.self="isOpen = !isOpen"
                 class="z-40 fixed top-0 right-0 left-0 bottom-0 flex justify-center items-center p-4 bg-gray-600 bg-opacity-25">
                <div class="bg-gray-700 p-5 rounded">
                    <form @submit="preventDefault" class="px-5 py-2 rounded flex flex-col items-center">
                        <h3 class="text-white mb-2 text-xl">{{ type == 0 ? 'Add Todo' : 'Update Todo' }}</h3>

                        <textarea name="" id="" cols="30" rows="5" class="rounded" v-model="form.body"></textarea>
                        <button @click="submit()" type="button"
                                class="mt-3 py-1 px-4 rounded bg-white text-gray-700 cursor-pointer">Submit
                        </button>
                    </form>
                </div>
            </div>
            <div class="bg-white shadow-xl sm:rounded-lg py-3 flex justify-end">
                <div @click="isOpen = !isOpen" class="p-1 mx-2 bg-gray-600 text-white rounded cursor-pointer">Add Todo
                </div>
            </div>
            <div class="bg-white shadow-xl sm:rounded-lg">
                <table class="table-auto  w-full m-auto border">
                    <thead class="bg-gray-400 text-white">
                    <tr>
                        <th class="border border-black">#</th>
                        <th class="border border-black">Content</th>
                        <th class="border border-black">User Name</th>
                        <th colspan="2" class="border border-black">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="todo in mytodos" :key="todo.id">
                        <td class="border border-black text-center">{{ todo.id }}</td>
                        <td class="border border-black">{{ todo.body }}</td>
                        <td class="border border-black">{{ todo.user.name }}</td>
                        <td @click="deleteTodo(todo.id)" class="text-center  border-b-2 border-gray-600">
                            <button class="bg-red-600 text-white m-1 p-1 rounded">X
                            </button>
                        </td>
                        <td @click="updateTodo(todo)" class="text-center   border-b-2 border-gray-600">
                            <button class="bg-green-500 text-white m-1 p-1 rounded">U</button>
                        </td>
                    </tr>
                    </tbody>

                </table>
                <pagination class="mt-6" :links="todos.links"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import pagination from '@/Components/Pagination'

export default {
    props: ["userName", "todos"],
    data() {
        return {
            mytodos: [],
            isOpen: false,
            type: 0,
            form: this.$inertia.form({
                body: '',
                id: ''
            })
        };
    },
    created() {
        this.mytodos = this.todos.data;
        console.log('zaid ')
    },
    methods: {
        deleteTodo(todoId) {
            if (confirm('are you sure to delete')) {
                this.mytodos = this.mytodos.filter(function (value) {
                    return value.id != todoId;
                });
                this.form.delete(route('dashboard.destroy', todoId))
            }
        },
        submit() {
            if (this.type == 0) {
                this.form.post(route('dashboard.store'), {
                    preserveScroll: true,
                    // resetOnSuccess: false,
                    onSuccess: () => this.form.reset(),
                });
            } else {
                this.form.put(route('dashboard.update', this.form.id), {
                    preserveScroll: true,
                    resetOnSuccess: false,
                });
            }
            this.type = 0;
            this.isOpen = false;
        },
        updateTodo(todo) {
            this.type = 1;
            this.form.body = todo.body;
            this.form.id = todo.id;
            this.isOpen = true;

        }
    },
    components: {
        AppLayout, pagination
    },
};
</script>
