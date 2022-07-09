import Head from "next/head"
import Dash from "../components/layout/Dash"
import SystemStats from "../components/ui/SystemStats"
import CardStats from "../components/ui/CardStats"
import RecentQueries from "../components/ui/RecentQueries"

export default function Dashboard() {
    return (
        <>
            <Head>
                <title>Dashboard</title>
            </Head>
            <Dash>
                <CardStats />
                <SystemStats />
                <RecentQueries />
            </Dash>
        </>
    )
}
