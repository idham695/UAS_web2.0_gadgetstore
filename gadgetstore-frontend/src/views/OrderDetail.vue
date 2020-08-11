<template>
	<div>
		<v-subheader>Order Detail</v-subheader>
		<v-card flat>
			<v-container>
				<v-simple-table>
					<thead>
						<th class="text-left">Name</th>
						<th class="text-left">Price</th>
					</thead>
					<tbody>
						<tr v-for="item in items" :key="item.id">
							<td>{{ item.invoice_number}}</td>
							<td>{{ item.total_price}}</td>
							<td>{{ item.courier_service}}</td>
							<td>{{ item.status}}</td>
						</tr>
					</tbody>
				</v-simple-table>
				<v-spacer></v-spacer>
				<!--<v-simple-table>
					<thead>
						<th class="text-left">Order Summary</th>
					</thead>
					<tbody>
						<tr>
							<td>Total Price</td>
							<td>{{ detailsOrder.data.total_price }}</td>
						</tr>
						<tr>
							<td>Order Date</td>
							<td>{{ detailsOrder.data.created_at }}</td>
						</tr>
						<tr>
							<td>Status Order</td>
							<td>{{ detailsOrder.data.status }}</td>
						</tr>
					</tbody>
				</v-simple-table>-->
			</v-container>
		</v-card>
	</div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
	data() {
		return {
			items: [],
		};
	},
	computed: {
		...mapGetters({
			user: "auth/user"
		})
	},
	methods: {
		...mapActions({
			setOrder: "order/set"
		})
	},
	mounted() {
		let id = this.$route.params.id;
		console.log(id);
		let config = {
			headers: {
				Authorization: "Bearer " + this.user.api_token
			}
		};
		this.axios
			.get("/orderdetail/" + id, config)
			.then(response => {
				let { data } = response.data.data;
				this.items = data
			})
			.catch(error => {
				let { data } = error.response;
				this.setAlert({
					status: true,
					text: data.message,
					color: "error"
				});
			});
	},
	created() {
    let id = this.$route.params.id;
    this.axios
      .get("/my-order/" + id)
      .then((response) => {
        let order = response.data.data;
        this.item = order;
      })
      .catch((error) => {
        let responses = error.response;
        console.log(responses);
      })}
}
</script>
