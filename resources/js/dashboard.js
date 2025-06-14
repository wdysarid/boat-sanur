// import { dashboardApi } from "./api"
// Dashboard JavaScript
console.log('Dashboard loaded');
// document.addEventListener("DOMContentLoaded", () => {
//   initDashboard()
// })

// async function initDashboard() {
//   try {
//     // Fetch dashboard summary data
//     const summaryData = await dashboardApi.getSummary()
//     updateSummaryCards(summaryData)

//     // Fetch sales data for chart
//     const salesData = await dashboardApi.getSalesData()
//     renderSalesChart(salesData)

//     // Fetch statistics
//     const statistics = await dashboardApi.getStatistics()
//     updateStatistics(statistics)
//   } catch (error) {
//     console.error("Error initializing dashboard:", error)
//     showErrorMessage("Failed to load dashboard data. Please try again later.")
//   }
// }

// function updateSummaryCards(data) {
//   // Update total sales
//   if (data.totalSales) {
//     document.getElementById("total-sales-amount").textContent = formatCurrency(data.totalSales.amount)
//     document.getElementById("total-sales-percentage").textContent = `${data.totalSales.percentage}%`

//     // Update trend icon
//     const trendElement = document.getElementById("total-sales-trend")
//     if (data.totalSales.trend === "up") {
//       trendElement.innerHTML =
//         '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" /></svg>'
//       document.getElementById("total-sales-percentage").classList.add("text-green-600")
//     } else {
//       trendElement.innerHTML =
//         '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1v-5a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd" /></svg>'
//       document.getElementById("total-sales-percentage").classList.add("text-red-600")
//     }
//   }

//   // Update other summary cards similarly
//   // ...
// }

// function renderSalesChart(data) {
//   // This is a placeholder for chart rendering
//   // In a real implementation, you would use a library like Chart.js
//   console.log("Rendering sales chart with data:", data)

//   // Example: Update chart bars with real data
//   const chartContainer = document.querySelector(".sales-chart-container")
//   if (chartContainer && data.months && data.values) {
//     const bars = chartContainer.querySelectorAll(".chart-bar")
//     const labels = chartContainer.querySelectorAll(".chart-label")

//     data.months.forEach((month, index) => {
//       if (bars[index] && labels[index]) {
//         const value = data.values[index]
//         const maxValue = Math.max(...data.values)
//         const percentage = (value / maxValue) * 100

//         bars[index].style.height = `${percentage}%`
//         labels[index].textContent = month
//       }
//     })
//   }
// }

// function updateStatistics(data) {
//   // Update statistics tables or charts
//   // ...
// }

// function formatCurrency(amount) {
//   return new Intl.NumberFormat("id-ID", {
//     style: "currency",
//     currency: "IDR",
//     minimumFractionDigits: 0,
//   }).format(amount)
// }

// function showErrorMessage(message) {
//   // Create and show error message to user
//   const alertElement = document.createElement("div")
//   alertElement.className = "bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
//   alertElement.role = "alert"
//   alertElement.innerHTML = `
//         <strong class="font-bold">Error!</strong>
//         <span class="block sm:inline">${message}</span>
//     `

//   const container = document.querySelector(".dashboard-container")
//   if (container) {
//     container.prepend(alertElement)

//     // Auto-remove after 5 seconds
//     setTimeout(() => {
//       alertElement.remove()
//     }, 5000)
//   }
// }
