import Navbar from "../ui/Navbar"
import Sidebar from "../ui/Sidebar"
import SidebarOverlay from "../ui/SidebarOverlay"

export default function Dash({ children }) {
    return (
        <>
            <div className="drawer">
                <input id="my-drawer" type="checkbox" className="drawer-toggle" />
                <div className="drawer-content py-20">
                    <Navbar />
                    <Sidebar sideState={false} />
                    <section className="container px-2 py-5 mx-auto mb-3">
                        {children}
                    </section>
                </div>
                <SidebarOverlay />
            </div>
        </>
    )
}
