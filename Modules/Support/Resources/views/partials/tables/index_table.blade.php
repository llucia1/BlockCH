<template v-if="!preloader">

    <div v-if="rows.data.length > 0">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>#</th>
                    <th>Asunto</th>
                    <th>Alta</th>
                    <th></th>
                </tr>

            </thead>

            <tbody>
                        
                <tr v-for="row in rows.data">
                    
                    <th scope="row" v-text="row.id"></th>

                    <td><a v-text="row.subject" class="dropdown-item" :href="editUrl + row.id"></a></td>

                    <td v-text="row.created_at"></td>

                    <td style="text-align:center;">

                        <a :href="editUrl + row.id" class="btn btn-color-dark btn-gradient-light">Ver</a>

                    </td>

                </tr>

            </tbody>

        </table>

        <ul class="pagination float-right">
            
            <li v-if="rows.prev_page_url != null" @click="getDataByPage(rows.current_page - 1)" class="page-item"><a class="page-link"><span aria-hidden="true">«</span></a></li>

            <li v-if="rows.last_page > 1" v-for="page in rows.last_page" @click="getDataByPage(page)" :key="page" class="page-item" :class="{'active': (rows.current_page == page)}"><a v-text="page" class="page-link"></a></li>

            <li v-if="rows.next_page_url != null" @click="getDataByPage(rows.current_page + 1)" class="page-item"><a class="page-link"><span aria-hidden="true">»</span></a></li>

        </ul>

    </div>

    <span v-else class="d-flex align-items-center purchase-popup col-12">

        {!! trans('app.noDataShow') !!}
       
    </span>


</template>