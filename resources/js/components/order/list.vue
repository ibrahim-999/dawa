<template>
<div class="card">
    <div class="card-body">
        <div class="card-widgets">
            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
            <a data-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="false"
               aria-controls="cardCollpase5"><i class="mdi mdi-minus"></i></a>
            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
        </div>
        <h4 class="header-title mb-0">Top Selling Products</h4>

        <div id="cardCollpase5" class="collapse pt-3 show">
            <div class="table-responsive">
                <table class="table table-hover table-centered mb-0">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>User</th>
                        <th>type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="order in orders">
                        <td>{{order.order_code}}</td>
                        <td>{{order.user.name}}</td>
                        <td>{{order.type}}</td>
                        <td>{{order.status}}</td>
                        <td>{{order.status}}</td>
                    </tr>
                    </tbody>
                </table>
            </div> <!-- end table responsive-->
        </div> <!-- collapsed end -->
    </div> <!-- end card-body -->
</div> <!-- end card-->
</template>

<script>
import DB from '/resources/js/firebase.js';
export default {
    name: "orders",
    components: {
    },
    data() {
        return {
            orders: [],
            isLoading: true,
            isConnected: false
        }
    },
    mounted() {
        this.getOrders()
        console.log('list')
        console.log(this.orders)
    },
    methods: {
        getOrders()
        {
            var newOrders = DB.ref( DB.getDatabase(),'new_orders/' );
            DB.onValue(newOrders, (snapshot) => {
                this.orders  = snapshot.val();
                console.log(this.orders)
            });
        }
    }
}
</script>
