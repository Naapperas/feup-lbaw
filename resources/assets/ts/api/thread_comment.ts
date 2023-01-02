import { apiFetch } from ".";
import { ThreadComment } from "../types/thread_comment";

export const getThreadComment = (threadCommentId: string) =>
    apiFetch<ThreadComment>(`/api/thread-comment/${threadCommentId}`);

export const newThreadComment = (threadComment: ThreadComment) =>
    apiFetch<ThreadComment>("/api/thread-comment/new", "POST", threadComment);

export const editThreadComment = (threadComment: ThreadComment) =>
    apiFetch<ThreadComment>(
        `/api/thread-comment/${threadComment.id}`,
        "PUT",
        threadComment
    );

export const deleteThreadComment = (threadCommentId: string) =>
    apiFetch<ThreadComment>(`/api/thread-comment/${threadCommentId}`, "DELETE");
