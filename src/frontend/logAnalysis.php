<?php

namespace App\Frontend;

require '../../index.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoggingAnalysis</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    <div class="flex justify-center px-28 my-20 " id="app">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-4">

                <form @submit.prevent="getFirstLines">
                    <div class="flex justify-center">
                        <input type="text" id="table-search" v-model="filePath" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Enter the file path e.g /var/log">
                        <button class="ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-900 dark:focus:ring-gray-700">View </button>
                        <!-- <input type="hidden" name="submit"> -->
                    </div>
                </form>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            line Num
                        </th>
                        <th scope="col" class="px-6 py-3">
                            line
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" v-for="(line,key) in lines" :key="line.id">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <span>{{key}}</span>
                            </div>
                        </td>
                        <!-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            Apple MacBook Pro 17"
                        </th> -->
                        <td class="px-6 py-4">
                            {{line}}
                        </td>
                    </tr>


                </tbody>
            </table>
            <div class="flex justify-center py-12">
                <button @click="getFirstLines" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">|< </button>
                        <button @click="getPreviousLines" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            < </button>
                                <button @click="getNextLines" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">> </button>
                                <button @click="getLastlines" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">>| </button>
            </div>
        </div>
    </div>




    <script src="https://unpkg.com/vue@3"></script>
    <script>
        let APP_URL = `/homework-challenge-logging/src/frontend/api.php`;
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    // message: 'Hello Vue!',
                    filePath: "",
                    lines: [],
                    currentLine: 0

                }
            },
            methods: {
                async getFirstLines() {
                    let data = {
                        'file': this.filePath
                    }
                    const response = await axios.post(APP_URL + '/getFirstLines',
                        data
                    );

                    this.lines = response.data;
                    this.currentLine = Object.keys(this.lines).pop();
                },
                async getLastlines() {
                    let data = {
                        'file': this.filePath
                    }
                    const response = await axios.post(APP_URL + '/getLastlines',
                        data
                    );
                    this.lines = response.data;
                    this.currentLine = Object.keys(this.lines).pop();
                },
                async getPreviousLines() {
                    let data = {
                        'file': this.filePath,
                        'currentLine': this.currentLine
                    }
                    const response = await axios.post(APP_URL + '/getPreviousLines',
                        data
                    );

                    this.lines = response.data;
                    this.currentLine = Object.keys(this.lines).pop();
                },
                async getNextLines() {
                    let data = {
                        'file': this.filePath,
                        'currentLine': this.currentLine
                    }
                    const response = await axios.post(APP_URL + '/getNextLines',
                        data
                    );

                    this.lines = response.data;
                    this.currentLine = Object.keys(this.lines).pop();

                },
            },

        }).mount('#app')
    </script>
</body>

</html>