import { SwitchVerticalIcon, WifiIcon, CollectionIcon, DuplicateIcon } from '@heroicons/react/solid'

export default function CardStats() {
    return (
        <>
            <div className="grid grid-cols-4 gap-5 my-5">
                <div className="bg-sky-800 h-32 text-white rounded">
                    <div className="font-bold bg-sky-600 p-3 rounded rounded-br-none rounded-bl-none">
                        <SwitchVerticalIcon className="w-5 h-5 inline mr-1" />
                        Req / Res Status
                    </div>
                    <div className="flex w-full">
                        <div className="grid h-20 flex-grow place-items-center">
                            <div><span className="text-2xl font-extrabold">50</span><sup> / Hours</sup></div>
                        </div>
                        <div className="divider divider-horizontal mx-0"></div>
                        <div className="grid h-20 flex-grow place-items-center">
                            <div><span className="text-2xl font-extrabold">50</span><sup> / Hours</sup></div>
                        </div>
                    </div>
                </div>
                <div className="bg-sky-800 h-32 text-white rounded">
                    <div className="font-bold bg-sky-600 p-3 rounded rounded-br-none rounded-bl-none">
                        <WifiIcon className="w-5 h-5 inline mr-1" />
                        Connected Clients
                    </div>
                    <div className="grid h-20 flex-grow place-items-center">
                        <div><span className="text-2xl font-extrabold">50</span><sup> / Hours</sup></div>
                    </div>
                </div>
                <div className="bg-sky-800 h-32 text-white rounded">
                    <div className="font-bold bg-sky-600 p-3 rounded rounded-br-none rounded-bl-none">
                        <CollectionIcon className="w-5 h-5 inline mr-1" />
                        Total Collections
                    </div>
                    <div className="grid h-20 flex-grow place-items-center">
                        <div><span className="text-2xl font-extrabold">45</span><sup> / Collections</sup></div>
                    </div>
                </div>
                <div className="bg-sky-800 h-32 text-white rounded">
                    <div className="font-bold bg-sky-600 p-3 rounded rounded-br-none rounded-bl-none">
                        <DuplicateIcon className="w-5 h-5 inline mr-1" />
                        Total Documents
                    </div>
                    <div className="grid h-20 flex-grow place-items-center">
                        <div><span className="text-2xl font-extrabold">7395</span><sup> / Documents</sup></div>
                    </div>
                </div>
            </div>
        </>
    )
}
