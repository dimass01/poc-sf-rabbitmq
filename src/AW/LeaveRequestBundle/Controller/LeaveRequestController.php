<?php
declare(strict_types = 1);

namespace AW\LeaveRequestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AW\LeaveRequestBundle\Service\LeaveRequestService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/leave_request", service="aw_leave_request.controller.leaveRequest")
 */
class LeaveRequestController extends Controller
{
    /**
     * @var LeaveRequestService
     */
    private $leaveRequestService;

    /**
     * LeaveRequestController constructor.
     * @param LeaveRequestService $leaveRequestService
     */
    public function __construct(LeaveRequestService $leaveRequestService)
    {
        $this->leaveRequestService = $leaveRequestService;
    }

    /**
     * @param Request $request
     *
     * @Method({"POST"})
     * @Route("/create")
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $result = $this->leaveRequestService->create(json_decode($request->getContent(), true));

        return new Response($result);
    }
}
