import Dash from "../components/layout/Dash";
import Head from "next/head";
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Filler,
    Legend,
} from 'chart.js';
import { Line } from 'react-chartjs-2';
import { useState } from "react";

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Filler,
    Legend
)

let labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July']
let datasetsData = [10, 34, 67, 87, 53, 75, 89]

const options = {
    responsive: true,
    plugins: {
        legend: {
            display: false,
        },
        title: {
            display: false,
        },
    },
}

let chartData = {
    labels: labels,
    datasets: [
        {
            fill: true,
            label: 'Dataset 2',
            data: datasetsData,
            borderColor: 'rgb(53, 162, 235)',
            backgroundColor: 'rgba(53, 162, 235, 0.5)',
        },
    ],
}

export default function Stats() {

    const [data, setData] = useState(chartData)
    const getNewData = () => {
        let newDatasetsData = [...chartData.datasets[0].data, ...[d]]
        let newLabels = [...chartData.labels, ...['August']]
        setData({
            labels: newLabels,
            datasets: [
                {
                    fill: true,
                    label: 'Dataset 2',
                    data: newDatasetsData,
                    borderColor: 'rgb(53, 162, 235)',
                    backgroundColor: 'rgba(53, 162, 235, 0.5)',
                },
            ],
        })
        return data
    }

    const handleClick = () => {
        getNewData()
    }

    return (
        <>
            <Head>
                <title>Statistics</title>
            </Head>
            <Dash>
                <h1>Statistics</h1>
                <Line options={options} data={data} id='line-chart' height={40} />
                <button className="btn btn-secondary" onClick={handleClick}>Add New Data</button>
            </Dash>
        </>
    )
}
