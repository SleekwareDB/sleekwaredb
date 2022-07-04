import Navbar from "../ui/Navbar";
import Sidebar from "../ui/Sidebar";
import SidebarOverlay from "../ui/SidebarOverlay";
import createRandomStat from "../utils/Utils";

export default function Dash() {
    const stats = [
        {
            "--value": createRandomStat(0,100),
            "--size": "6rem",
            "label": "Disk Read",
            "styling": "radial-progress font-bold text-center bg-primary text-primary-content border-4 border-primary"
        },
        {
            "--value": createRandomStat(0, 100),
            "--size": "7rem",
            "label": "Disk Write",
            "styling": "radial-progress font-bold text-center bg-success text-success-content border-4 border-success"
        },
        {
            "--value": createRandomStat(0, 100),
            "--size": "10rem",
            "label": "CPU",
            "styling": "radial-progress font-bold text-center bg-warning text-warning-content border-4 border-warning"
        },
        {
            "--value": createRandomStat(0, 100),
            "--size": "7rem",
            "label": "Request",
            "styling": "radial-progress font-bold text-center bg-error text-error-content border-4 border-error"
        },
        {
            "--value": createRandomStat(0, 100),
            "--size": "6rem",
            "label": "Response",
            "styling": "radial-progress font-bold text-center bg-secondary text-secondary-content border-4 border-secondary"
        }
    ]

    return (
        <>
            <div className="drawer">
                <input id="my-drawer" type="checkbox" className="drawer-toggle" />
                <div className="drawer-content">
                    <Navbar />
                    <Sidebar sideState={false} />
                    <section className="container px-2 py-5 mx-auto mb-3">
                        <div class="grid grid-cols-4 gap-5">
                            <div className="bg-sky-800 h-32 text-white rounded">
                                <div className="font-bold bg-sky-600 p-3 rounded rounded-br-none rounded-bl-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                    </svg>
                                    Req / Res Status
                                </div>
                                <div class="flex w-full">
                                    <div class="grid h-20 flex-grow place-items-center">
                                        <div><span className="text-2xl font-extrabold">50</span><sup> / Hours</sup></div>
                                    </div>
                                    <div class="divider divider-horizontal mx-0"></div>
                                    <div class="grid h-20 flex-grow place-items-center">
                                        <div><span className="text-2xl font-extrabold">50</span><sup> / Hours</sup></div>
                                    </div>
                                </div>
                            </div>
                            <div className="bg-sky-800 h-32 text-white rounded">
                                <div className="font-bold bg-sky-600 p-3 rounded rounded-br-none rounded-bl-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fillRule="evenodd" d="M17.778 8.222c-4.296-4.296-11.26-4.296-15.556 0A1 1 0 01.808 6.808c5.076-5.077 13.308-5.077 18.384 0a1 1 0 01-1.414 1.414zM14.95 11.05a7 7 0 00-9.9 0 1 1 0 01-1.414-1.414 9 9 0 0112.728 0 1 1 0 01-1.414 1.414zM12.12 13.88a3 3 0 00-4.242 0 1 1 0 01-1.415-1.415 5 5 0 017.072 0 1 1 0 01-1.415 1.415zM9 16a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clipRule="evenodd" />
                                    </svg>
                                    Connected Clients
                                </div>
                                <div className="grid h-20 flex-grow place-items-center">
                                    <div><span className="text-2xl font-extrabold">50</span><sup> / Hours</sup></div>
                                </div>
                            </div>
                            <div className="bg-sky-800 h-32 text-white rounded">
                                <div className="font-bold bg-sky-600 p-3 rounded rounded-br-none rounded-bl-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Total Collections
                                </div>
                                <div className="grid h-20 flex-grow place-items-center">
                                    <div><span className="text-2xl font-extrabold">45</span><sup> / Collections</sup></div>
                                </div>
                            </div>
                            <div className="bg-sky-800 h-32 text-white rounded">
                                <div className="font-bold bg-sky-600 p-3 rounded rounded-br-none rounded-bl-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                    </svg>
                                    Total Documents
                                </div>
                                <div className="grid h-20 flex-grow place-items-center">
                                    <div><span className="text-2xl font-extrabold">7395</span><sup> / Documents</sup></div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section className="container px-36 py5 mx-auto mb-3">
                        <div class="grid grid-cols-5">
                            {
                                stats.map(item => {
                                    return (
                                        <div className="flex justify-center items-center">
                                            <div className={item.styling} style={item}>{item["--value"]}% <span className="text-sm">{item.label}</span></div>
                                        </div>
                                    )
                                })
                            }
                        </div>
                    </section>
                </div>
                <SidebarOverlay />
            </div>
        </>
    )
}
