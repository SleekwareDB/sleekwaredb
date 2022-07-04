export default function Navbar() {
    return (
        <>
            <div className="navbar bg-base-100">
                <div className="flex-none">
                    <label className="btn btn-square btn-ghost drawer-button" for="my-drawer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" className="inline-block w-5 h-5 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </label>
                </div>
                <div className="flex-1">
                    <a className="btn btn-ghost normal-case text-xl">Sleekware<span className="font-extrabold text-sky-500">DB</span></a>
                </div>
                <div class="flex-none">
                    <ul class="menu menu-horizontal p-0">
                        <li><a>Anomaly <div class="badge badge-xs badge-secondary badge-outline py-2">30.2%</div></a></li>
                        <li tabindex="0">
                            <a>
                                Alerts <div class="badge badge-xs badge-accent py-2">1</div>
                                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" /></svg>
                            </a>
                            <ul class="p-2 bg-base-100">
                                <li><a>Submenu 1</a></li>
                                <li><a>Submenu 2</a></li>
                            </ul>
                        </li>
                        <li>
                            <div class="w-16">
                                <img src="https://placeimg.com/80/80/people" class="rounded-full" />
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </>
    )
}
