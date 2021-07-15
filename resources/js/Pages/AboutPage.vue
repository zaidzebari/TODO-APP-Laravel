<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                About Page
            </h2>
        </template>
    <div CLASS="flex justify-center items-center w-full h-full">
        <h1>Developed by Zaid Salah</h1>
    </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";


export default {
    name: "AboutPage",
    components: {
        AppLayout
    }
}
</script>

<style scoped>

</style>
