<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Your Reservation Details</title>
	<style>
		body {
			font-family: Arial, sans-serif;
		}

		.container {
			padding: 20px;
			max-width: 600px;
			margin: auto;
			background-color: #f9f9f9;
			border: 1px solid #ddd;
		}

		h2 {
			color: #333;
		}

		.details-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}

		.details-table th,
		.details-table td {
			border: 1px solid #ccc;
			padding: 10px;
			text-align: left;
		}

		.footer {
			margin-top: 30px;
			text-align: center;
			font-size: 13px;
			color: #555;
		}
	</style>
</head>

<body>
	<div class="container">
		<h2>Reservation Confirmation</h2>

		<p>Dear <strong>{{ $name }}</strong>,</p>

		<p>Thank you for your reservation. Below are your reservation details:</p>

		<table class="details-table">

			<tr>
				<th>Reservation Date</th>
				<td>{{ $date }}</td>
			</tr>
			<tr>
				<th>Reservation Time</th>
				<td>{{ $time }}</td>
			</tr>
			<tr>
				<th>Location</th>
				<td>Midway Dine</td>
			</tr>
			<tr>
				<th>Number of Guest</th>
				<td>{{ $no_guest }}</td>
			</tr>
		</table>

		<p>If you have any questions, feel free to reply to this email.</p>

		<div class="footer">
			<p>Thank you for choosing our service.</p>
			<p><strong>Email:</strong> support@midwaydine.com</p>
		</div>
	</div>
</body>

</html>