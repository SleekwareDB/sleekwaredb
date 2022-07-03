import Sidebar from "./Sidebar";

export default function SidebarOverlay() {
    return (
        <>
            <div className="drawer-side">
                <label for="my-drawer" className="drawer-overlay"></label>
                <Sidebar sideState={true}/>
            </div>
        </>
    )
}
