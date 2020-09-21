<template>
    <table class="table">

        <!--Table Head-->
        <thead v-if="table.headers">
        <tr>

            <!--Header-->
            <th v-for="header in table.headers"
                class="align-middle">{{ header }}</th>
            <!--Header-->

        </tr>
        </thead>
        <!--Table Head-->

        <!--Table Body-->
        <tbody>
        <tr v-for="row in table.data">

            <!--Data-->
            <td v-for="(data, key) in row"
                v-if="!exclude_keys.includes(key)"
                class="align-middle">
                {{ data }}
            </td>
            <!--Data-->

        </tr>
        </tbody>
        <!--Table Body-->

    </table>
</template>

<script>
    export default {
        props: ['table', 'exclude_keys'],
    }
</script>