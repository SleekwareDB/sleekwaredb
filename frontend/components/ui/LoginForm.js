import { useRouter } from "next/router";
import Version from "../addons/version";

export default function LoginForm() {
    const router = useRouter()

    const handleSubmit = function(e) {
        e.preventDefault()
        router.push('/dashboard')
    }

    return (
        <>
            <section className="w-screen h-screen flex justify-center items-center">
                <div className="card w-96 bg-base-100 shadow-xl">
                    <div className="card-body">
                        <h2 className="card-title justify-center">SleekwareDB</h2>
                        <div className="divider">Sign In</div>
                        <form method="post" onSubmit={handleSubmit}>
                            <input type="text" placeholder="Type username or email" className="input input-bordered input-secondary w-full max-w-xs mb-2" />
                            <div className="card-actions justify-center">
                                <button type="submit" className="btn btn-block btn-outline btn-secondary">Let Me In</button>
                                <Version />
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </>
    )
}
