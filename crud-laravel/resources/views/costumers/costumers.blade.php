<x-app>
    <x-header />
    <div class="w-full flex justify-center mt-8 text-4xl">
        <h1>Clientes</h1>
    </div>
    <section class="mt-8 p-20">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nome
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Data de nascimento
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($costumers as $costumer)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $costumer->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $costumer->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $costumer->country }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('costumer.edit', $costumer->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-4">Remover</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        <div class="mt-8 flex justify-between">
            {{ $costumers->links() }}
            <a href="{{route("costumer.create.view")}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Novo cliente</a>
        </div>
    </section>
</x-app>