<template>
    <table class="table table-sm">
        <tbody>
        <tr v-for="row in table">

            <!--Table Header-->
            <th class="w-50">{{ row.header }}</th>
            <!--Table Header-->

            <!--Table Data-->
            <td class="w-50">{{ row.data }}</td>
            <!--Table Data-->

        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['table'],
    }
</script>